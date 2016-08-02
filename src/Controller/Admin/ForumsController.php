<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * Forums Controller
 *
 * @property \App\Model\Table\ForumsTable $Forums
 * @property \App\Model\Table\SectionsTable $Sections
 */
class ForumsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $forums = $this->paginate($this->Forums->find('all')->contain(['Sections']));

        $this->set(compact('forums'));
        $this->set('_serialize', ['forums']);
        $this->set('page_parent', 'admin');
    }

    public function add()
    {
        $this->set('page_parent', 'admin');

        $forum = $this->Forums->newEntity();
        $sections = $this->Sections->find('list');

        if($this->request->is('post'))
        {
            $forum = $this->Forums->patchEntity($forum, $this->request->data);

            if($this->Forums->save($forum))
            {
                $this->Flash->success(__('Het nieuwe forum is opgeslagen!'));
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error(__('Er is iets fout gegaan tijdens het opslaan van het forum!'));
            }
        }

        $this->set(compact('forum', 'sections'));
    }

}
