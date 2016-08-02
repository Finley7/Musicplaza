<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Subforums Controller
 *
 * @property \App\Model\Table\SubforumsTable $Subforums
 */
class SubforumsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $subforums = $this->paginate($this->Subforums->find('all')->contain(['Forums']));

        $this->set(compact('subforums'));
        $this->set('_serialize', ['subforums']);
        $this->set('page_parent', 'admin');
    }

    public function add()
    {
        $this->set('page_parent', 'admin');

        $subforum = $this->Subforums->newEntity();
        $forums = $this->Forums->find('list');

        if($this->request->is('post'))
        {
            $subforum = $this->Subforums->patchEntity($subforum, $this->request->data);

            if($this->Subforums->save($subforum))
            {
                $this->Flash->success(__('Het nieuwe forum is opgeslagen!'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('Er is iets fout gegaan tijdens het opslaan van het forum!'));
            }
        }

        $this->set(compact('subforum', 'forums'));
    }

}
