<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Timeline Controller
 *
 * @property \App\Model\Table\TimelineTable $Timeline
 */
class TimelineController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $timeline = $this->paginate($this->Timeline);

        $this->set(compact('timeline'));
        $this->set('_serialize', ['timeline']);
    }

    /**
     * View method
     *
     * @param string|null $id Timeline id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timeline = $this->Timeline->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('timeline', $timeline);
        $this->set('_serialize', ['timeline']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);

        $timeline = $this->Timeline->newEntity();

        if(strlen($this->request->data['url']) < 1 ) {
            $this->Flash->error(__('Je hebt iets niet goed ingevuld!'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }
        else {
            switch ($this->request->data['type']) {
                case 'youtube':
                    $youtube_url = explode('/', $this->request->data['url']);

                    if(isset($youtube_url[2])) {
                        if ($youtube_url[2] == "www.youtube.com") {
                            $this->request->data['url'] = str_replace("watch?v=", "", $youtube_url[3]);
                        } else {
                            $this->request->data['url'] = $youtube_url[3];
                        }
                    }
                    else
                    {
                        $this->Flash->error(__('Dit is geen geldige YouTube-URL'));
                        return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
                    }
                    break;

                case 'spotify':
                    $spotify_url = explode(':', $this->request->data['url']);

                    $this->request->data['url'] = $spotify_url[2];
                    break;

            }

            $timeline->user_id = $this->Auth->user('id');

            $timeline = $this->Timeline->patchEntity($timeline, $this->request->data);

            if($this->Timeline->save($timeline)) {
                $this->Flash->success(__('Bericht geplaatst!'));
                return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
            }
            else
            {
                $this->Flash->error(__('Er is iets fout gegaan!'));
                return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
            }

        }

    }

    /**
     * Edit method
     *
     * @param string|null $id Timeline id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timeline = $this->Timeline->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timeline = $this->Timeline->patchEntity($timeline, $this->request->data);
            if ($this->Timeline->save($timeline)) {
                $this->Flash->success(__('The timeline has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The timeline could not be saved. Please, try again.'));
            }
        }
        $users = $this->Timeline->Users->find('list', ['limit' => 200]);
        $this->set(compact('timeline', 'users'));
        $this->set('_serialize', ['timeline']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Timeline id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timeline = $this->Timeline->get($id);
        if ($this->Timeline->delete($timeline)) {
            $this->Flash->success(__('The timeline has been deleted.'));
        } else {
            $this->Flash->error(__('The timeline could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
