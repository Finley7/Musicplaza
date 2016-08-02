<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($thread_id = null, $comment_id = null)
    {

        if (is_null($comment_id)) {
            $thread = $this->Threads->get($thread_id);
            $comment = null;
        }
        else {
            $comment = $this->Comments->get($comment_id);
            $thread = $this->Threads->get($comment->thread_id);
        }

        $report = $this->Reports->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['reported_by'] = $this->Auth->user('id');
            $this->request->data['reason'] = h($this->request->data['reason']);
            $this->request->data['thread_id'] = $thread->id;
            $this->request->data['comment_id'] = !is_null($comment) ? $comment->id : null;

            $report = $this->Reports->patchEntity($report, $this->request->data);


            if ($this->Reports->save($report)) {
                $this->Flash->success(__('Bedankt voor je aangifte, we nemen hem zo snel mogelijk'));

                return $this->redirect([
                    'controller' => 'Threads',
                    'action' => 'view',
                    $thread->id,
                    $thread->slug,
                    '?' => ['action' => 'lastpost']
                ]);
            }
            else {
                $this->Flash->error(__('The report could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('report', 'thread', 'comment'));
        $this->set('_serialize', ['report']);
        $this->set('page_parent', 'community');
    }

}
