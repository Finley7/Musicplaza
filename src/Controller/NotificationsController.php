<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 */
class NotificationsController extends AppController
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
        $notifications = $this->paginate($this->Notifications);

        $this->set(compact('notifications'));
        $this->set('_serialize', ['notifications']);
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('notification', $notification);
        $this->set('_serialize', ['notification']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notification = $this->Notifications->newEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->data);
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The notification could not be saved. Please, try again.'));
            }
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users'));
        $this->set('_serialize', ['notification']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notifications->get($id);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function handle($id)
    {
        $this->request->allowMethod(['post']);

        $notification = $this->Notifications->get($id);
        $notification->is_read = 1;

        $route_handler = explode('/', $notification->url);

        if($this->Notifications->save($notification)) {
            return $this->redirect(['controller' => $route_handler[1], 'action' => $route_handler[2], isset($route_handler[3]) ? $route_handler[3] : '']);
        }
        else
        {
            $this->Flash->error(__('Er is een onbekende fout opgetreden'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'landing']);
        }
    }
}
