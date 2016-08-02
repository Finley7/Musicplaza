<?php
namespace App\Controller\Mod;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\NotFoundException;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => [
                'Users',
                'Threads'
            ]
        ]);

        $thread = $this->Threads->get($comment->thread->id);

        if ($comment->user->id != $this->Auth->user('id')) {
            throw new NotFoundException("Niet gevonden!");
        }

        if ($this->request->is([
            'post',
            'put',
            'patch'
        ])
        ) {

            $comment->edit_by = $this->Auth->user('id');

            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->touch($comment, 'Comments.edited') && $this->Comments->save($comment)) {


                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect([
                    'controller' => 'Threads',
                    'action' => 'view',
                    $comment->thread->id,
                    $comment->thread->slug,
                    '?' => ['pid' => $comment->id]
                ]);
            }
            else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('comment', 'thread'));
        $this->set('page_parent', 'community');
        $this->set('_serialize', ['comment']);
    }

    public function delete($id)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);

        $comment = $this->Comments->get($id, ['contain' => 'Threads']);
        $comment->deleted = 1;

        if ($this->Comments->save($comment)) {
            $this->Flash->success(__('De reactie is niet meer zichtbaar voor leden!'));

            return $this->redirect([
                'controller' => 'Threads',
                'action' => 'view',
                'prefix' => false,
                $comment->thread->id,
                $comment->thread->slug,
            ]);
        }
        else {
            $this->Flash->error(__('De reactie kon niet verwijderd worden!'));
        }


    }

}
