<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TimelineWows Controller
 *
 * @property \App\Model\Table\TimelineWowsTable $TimelineWows
 */
class TimelineWowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $timelineWows = $this->paginate($this->TimelineWows);

        $this->set(compact('timelineWows'));
        $this->set('_serialize', ['timelineWows']);
    }

    /**
     * View method
     *
     * @param string|null $id Timeline Wow id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timelineWow = $this->TimelineWows->get($id, [
            'contain' => []
        ]);

        $this->set('timelineWow', $timelineWow);
        $this->set('_serialize', ['timelineWow']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $this->request->allowMethod(['post', 'put']);

        $excitingTimelineWow = $this->TimelineWows->find('all')->where(['user_id' => $this->Auth->user('id'), 'timeline_id' => h($id)])->first();

        if(!is_null($excitingTimelineWow)) {
            $this->Flash->error(__("Je hebt deze tijdlijn al ge-wow'd!"));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }

        $timelineWow = $this->TimelineWows->newEntity(['associated' => 'Users', 'Timeline']);

        $timelineWow->user_id = $this->Auth->user('id');
        $timelineWow->timeline_id = h($id);

        $timelineWow = $this->TimelineWows->patchEntity($timelineWow, $this->request->data, ['associated' => 'Users', 'Timeline']);

        if ($this->TimelineWows->save($timelineWow, ['associated' => 'Users', 'Timeline'])) {
            $this->Flash->success(__('Je wow is geplaatst!'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        } else {
            $this->Flash->error(__('The timeline wow could not be saved. Please, try again.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Timeline Wow id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $timelineWow = $this->TimelineWows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timelineWow = $this->TimelineWows->patchEntity($timelineWow, $this->request->data);
            if ($this->TimelineWows->save($timelineWow)) {
                $this->Flash->success(__('The timeline wow has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The timeline wow could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('timelineWow'));
        $this->set('_serialize', ['timelineWow']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Timeline Wow id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timelineWow = $this->TimelineWows->get($id);
        if ($this->TimelineWows->delete($timelineWow)) {
            $this->Flash->success(__('The timeline wow has been deleted.'));
        } else {
            $this->Flash->error(__('The timeline wow could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
