<?php
namespace App\Controller\Mod;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\Event\Event;
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

    /**
     * @param $thread_id
     * @return \Cake\Network\Response|null
     */
    public function close($thread_id)
    {
        $this->request->allowMethod(['post',]);

        $thread = $this->Threads->get($thread_id);

        $thread->closed = 1;

        if ($this->Threads->save($thread)) {
            $this->Flash->success(__('De thread is gesloten!'));
        }
        else {
            $this->Flash->error(__('The thread could not be closed. Please, try again.'));
        }

        return $this->redirect([
            'action' => 'view',
            'prefix' => false,
            $thread->id,
            $thread->slug,
            '?' => ['action' => 'lastpost']
        ]);
    }

    /**
     * @param $thread_id
     * @return \Cake\Network\Response|null
     */
    public function open($thread_id)
    {
        $this->request->allowMethod(['post',]);

        $thread = $this->Threads->get($thread_id);

        $thread->closed = 0;

        if ($this->Threads->save($thread)) {
            $this->Flash->success(__('De thread is heropend!'));
        }
        else {
            $this->Flash->error(__('The thread could not be opened. Please, try again.'));
        }

        return $this->redirect([
            'action' => 'view',
            'prefix' => false,
            $thread->id,
            $thread->slug,
            '?' => ['action' => 'lastpost']
        ]);
    }

    public function move($thread_id)
    {
        $this->loadModel('Subforums');

        $thread = $this->Threads->get($thread_id);
        $forums = $this->Forums->find('list')->contain(['Subforums']);
        $subforums = $this->Subforums->find('list');

        if($this->request->is('post'))
        {
            if(!isset($this->request->data['forum_type']))
            {
                $this->Flash->error(__('Je hebt geen forum type geselecteerd!'));
            }
            else
            {
                if($this->request->data['forum_type'] == 'forum') {
                    $thread->forum_id = h($this->request->data['forum_id']);
                }
                else
                {
                    $parentForum = $this->Subforums->get(h($this->request->data['subforum_id']));

                    $thread->forum_id = $parentForum->parent_forum;
                    $thread->subforum_id = h($this->request->data['subforum_id']);
                }

                if($this->Threads->save($thread))
                {
                    $this->Flash->success(__('De thread is verplaatst!'));
                    return $this->redirect([
                        'action' => 'view',
                        'prefix' => false,
                        $thread->id,
                        $thread->slug,
                        '?' => ['action' => 'lastpost']
                    ]);
                }
                else
                {
                    $this->Flash->error(__('Er is iets fout gegaan tijdens het opslaan!'));
                }
            }
        }

        $this->set('page_parent', 'mod');
        $this->set(compact('thread', 'forums', 'subforums'));
        $this->set('title', __('Verplaats thread {0}', $thread->title));
    }
}
