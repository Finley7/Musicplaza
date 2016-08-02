<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {

        $this->set('users', $this->paginate($this->Users->find('all')->contain(['PrimaryRole'])));
        $this->set('_serialize', ['users']);

        $this->set('page_parent', 'admin');
        $this->set(__('Gebruiker beheer'));
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect('/');
            }
            $this->Flash->error(__('Ongeldige gebruikersnaam/wachtwoord combinatie!'));
        }

        $this->set('title', 'Aanmelden');
        $this->set('page_parent', 'user');
    }

    public function settings()
    {
        $editUser = $this->Users->get($this->Auth->user('id'), ['contain' => ['UserPreferences']]);

        $this->set('editUser', $editUser);
        $this->set('title', 'Bewerk je instellingen');
        $this->set('page_parent', 'settings');
    }

    public function avatar()
    {
        $editUser = $this->Users->get($this->Auth->user('id'), ['contain' => ['UserPreferences']]);

        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];

        if($this->request->is('post')){

            if(!@getimagesize($this->request->data['avatar']['tmp_name'])) {
                $this->Flash->error(__('Je hebt geen geldige avatar geselecteerd'));
                return $this->redirect(['view' => 'avatar']);
            }

            if(!in_array($this->request->data['avatar']['type'], $allowed_types)) {
                $this->Flash->error(__('Je hebt geen geldig formaat geupload'));
                return $this->redirect(['view' => 'avatar']);
            }

            if($this->request->data['avatar']['size'] > 2000000) {
                $this->Flash->error(__('Je hebt te grote avatar geupload!'));
                return $this->redirect(['view' => 'avatar']);
            }

            $ext = explode('/', $this->request->data['avatar']['type']);

            $avatar_url = 'avatar_' . Text::uuid() . '_' . $editUser->username . '.' . $ext[1];

            $editUser->avatar = $avatar_url;

            if($this->Users->save($editUser))
            {
                $image_info = file_get_contents($this->request->data['avatar']['tmp_name']);

                $avatar = new File('img/uploads/avatars/' . $avatar_url, true);
                $avatar->append($image_info);

                $avatar->create();

                $this->Auth->setUser($editUser->toArray());

                $this->Flash->success(__('Avatar geupload!'));
                return $this->redirect(['action' => 'settings']);
            }
            else
            {
                $this->Flash->error(__('Er iets fout gegaan tijdens het opslaan!'));
            }
        }

        $this->set('editUser', $editUser);

        $this->set('page_parent', 'settings');
    }

    public function autograph()
    {
        $editUser = $this->Users->get($this->Auth->user('id'));

        if($this->request->is(['post', 'put', 'patch']))
        {
            $editUser = $this->Users->patchEntity($editUser, $this->request->data);

            if($this->Users->save($editUser))
            {
                $this->Auth->setUser($editUser->toArray());
                $this->Flash->success(__('Je handtekening is aangepast'));
                return $this->redirect(['action' => 'settings']);
            }
            else
            {
                $this->Flash->error(__('Er is iets fout gegaan tijdens het opslaan!'));
            }
        }

        $this->set('editUser', $editUser);
        $this->set('page_parent', 'settings');
        $this->set('title', 'Bewerk je avatar');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return Object Redirects on successful add, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profile = $this->Users->get($id, ['contain' => 'PrimaryRole']);

        $threads = $this->Threads->findByAuthorId($profile->id);
        $comments = $this->Comments->findByAuthorId($profile->id);

        $this->set('page_parent', 'community');
        $this->set(compact('profile', 'threads', 'comments'));
        $this->set('title', __('Gebruiker {0}', $profile->username));
    }
    /**
     * Add method
     *
     * @return  Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if (!Configure::read('App.can_register')) {
            $this->Flash->error(__('Je kunt nu niet registreren, Probeer het later!'));

            return $this->redirect(['action' => 'login']);
        }
        $user = $this->Users->newEntity([
            'associated' => [
                'Roles',
                'UserPreferences'
            ]
        ]);
        if ($this->request->is('post')) {
            $this->request->data['roles']['_ids'] = [1];
            $this->request->data['primary_role'] = 1;
            $this->request->data['user_preferences']['_dob'] = $this->request->data['dob'];
            $user = $this->Users->patchEntity($user, $this->request->data, [
                'associated' => [
                    'Roles',
                    'UserPreferences'
                ]
            ]);


            if ($this->Users->save($user, [
                'associated' => [
                    'Roles',
                    'UserPreferences'
                ]
            ])
            ) {
                $this->Flash->success(__('Het account is aangemaakt. Je kunt nu inloggen!'));

                return $this->redirect([
                    'controller' => 'users',
                    'action' => 'login'
                ]);
            }
            else {
                $this->Flash->error(__('Er is iets fout gegaan tijdens het registreren van het account!'));
            }
        }

        $this->set('title', __('Create your account!'));
        $this->set('page_parent', 'add');
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function logout()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->user()) {
                $this->redirect($this->Auth->logout());
            }
        }
    }
}