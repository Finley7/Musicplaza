<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\I18n\Time;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\NotFoundException;

/**
 * Threads Controller
 *
 * @property \App\Model\Table\ThreadsTable $Threads
 */
class ThreadsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'Forums',
                'Users',
                'Subforums'
            ]
        ];
        $threads = $this->paginate($this->Threads);

        $this->set(compact('threads'));
        $this->set('_serialize', ['threads']);
    }

    /**
     * View method
     *
     * @param string|null $id Thread id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $slug = null)
    {
        $this->loadModel('Comments');
        $this->helpers = [
            'Tanuck/Markdown.Markdown' => [
                'parser' => 'GithubMarkdown'
            ]
        ];

        $this->paginate = [
            'limit' => 7,
            'contain' => ['Users' => ['PrimaryRole']]
        ];

        $replies = $this->Comments
            ->findByThreadId($id)
            ->order(['Comments.created_at' => 'asc'])
            ->contain(['Editor', 'Users' => ['PrimaryRole']]);


        $thread = $this->Threads->get($id, [
            'contain' => [
                'Forums',
                'Users' => ['PrimaryRole'],
                'Subforums',
                'Editor',
                'Comments' => [
                    'Users' => ['PrimaryRole'],
                    'Threads',
                ]
            ]
        ]);

        if ($replies->count() > 0) {
            if (isset($this->request->query['action']) && $this->request->query['action'] == 'lastpost') {
                $this->redirect([
                    'action' => 'view',
                    $thread->id,
                    $thread->slug,
                    '?' => ['page' => ceil($replies->count() / 7)],
                    '#' => 'pid' . $replies->last()->id
                ]);
            }

            if (isset($this->request->query['pid'])) {
                $postCount = 0;
                $postPosition = null;

                $replyQuery = $this->Comments->findByThreadId($thread->id)
                    ->select(['id'])
                    ->where(['deleted' => 0])
                    ->order(['created_at' => 'ASC']);

                foreach ($replyQuery as $reply) {
                    $postCount++;
                    if ($reply->id == $this->request->query['pid']) {
                        $postPosition = $postCount;
                    }
                }

                if (is_null($postPosition)) {
                    return false;
                }

                $this->redirect([
                    'action' => 'view',
                    $thread->id,
                    $thread->slug,
                    '?' => ['page' => ceil($postPosition / 7)],
                    '#' => 'pid' . h($this->request->query['pid'])
                ]);
            }
        }


        $this->set('thread', $thread);
        $this->set('replies', $this->paginate($replies));
        $this->set('_serialize', ['thread']);

        $this->set('page_parent', 'community');
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($forum_id)
    {
        if ($forum_id == null) {
            throw new NotFoundException();
        }

        $forum = $this->Forums->get($forum_id, ['contain' => 'Subforums']);
        $thread = $this->Threads->newEntity();

        if ($this->request->is('post')) {

            $this->request->data['lastposter_id'] = $this->Auth->user('id');
            $this->request->data['forum_id'] = $forum->id;
            $this->request->data['author_id'] = $this->Auth->user('id');
            $this->request->data['title'] = h($this->request->data['title']);

            $ceo_split = str_replace(' ', '-', $this->request->data['title']);
            $ceo_split = preg_replace("/[',.!:#$%^&*()_+ \/ <>~`@']/", "", $ceo_split);

            $this->request->data['slug'] = $ceo_split;

            $this->request->data['subforum_id'] = isset($this->request->data['subforum']) ? null : $this->request->data['subforum'];
            $this->request->data['body'] = h($this->request->data['body']);

            $thread->edit_by = $this->Auth->user('id');

            $thread = $this->Threads->patchEntity($thread, $this->request->data);

            if ($this->Threads->save($thread)) {
                $this->Flash->success(__('The thread has been saved.'));

                return $this->redirect([
                    'action' => 'view',
                    $thread->id,
                    $thread->slug,
                ]);
            }
            else {
                $this->Flash->error(__('The thread could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('thread', 'forums', 'users', 'subforums'));
        $this->set('_serialize', ['thread']);

        $this->set('forum', $forum);
        $this->set('page_parent', 'community');
    }

    /**
     * Edit method
     *
     * @param string|null $id Thread id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $thread = $this->Threads->get($id, [
            'contain' => ['Users']
        ]);

        $forum = $this->Forums->get($thread->forum_id, ['contain' => 'Subforums']);

        if ($thread->user->id != $this->Auth->user('id')) {
            throw new MethodNotAllowedException();
        }

        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])
        ) {

            $thread = $this->Threads->patchEntity($thread, $this->request->data);

            $thread->edit_by = $this->Auth->user('id');
            $ceo_split = str_replace(' ', '-', $this->request->data['title']);
            $ceo_split = preg_replace("/[',.!:#$%^&*()_+ \/ <>~`@']/", "", $ceo_split);

            $this->request->data['slug'] = $ceo_split;

            $this->request->data['subforum_id'] = ($this->request->data['subforum'] == "null") ? null : $this->request->data['subforum'];
            $this->request->data['body'] = h($this->request->data['body']);

            if ($this->Threads->touch($thread, 'Threads.edited') && $this->Threads->save($thread)) {
                $this->Flash->success(__('The thread has been saved.'));

                return $this->redirect([
                    'action' => 'view',
                    $thread->id,
                    $thread->slug,
                ]);
            }
            else {
                $this->Flash->error(__('The thread could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('thread', 'forum', 'users', 'subforums'));
        $this->set('page_parent', 'community');
        $this->set('title', __('Bewerk thread {0}', $thread->title));
        $this->set('_serialize', ['thread']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Thread id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $thread = $this->Threads->get($id);
        if ($this->Threads->delete($thread)) {
            $this->Flash->success(__('The thread has been deleted.'));
        }
        else {
            $this->Flash->error(__('The thread could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
