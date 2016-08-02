<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Model\Entity\User;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Exception\ForbiddenException;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Sections');
        $this->loadModel('Forums');
        $this->loadModel('Threads');
        $this->loadModel('Comments');
        $this->loadModel('Notifications');

        /*
         * Loading custom components
         */
        $this->loadComponent('Bol');

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Csrf');

        $this->loadComponent('Auth', [
            'authError' => __("Je hebt geen toegang om deze locatie te bezoeken, of je moet ingelogd zijn!"),
            'authorize' => 'VinylVinder',
            'unauthorizedRedirect' => '/',
            'prefix' => false,
            'loginRedirect' => [
                'controller' => 'Forums',
                'action' => 'index',
                'prefix' => false
            ],
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login',
                'prefix' => false
            ],
            'logoutRedirect' => [
                'controller' => '/'
            ],
        ]);

        if ($this->Auth->user()) {
            $user = new User($this->Auth->user());
            $this->set('user', $user);

            $this->set('notifications', $this->Notifications->findByUserId($this->Auth->user('id'))->order('is_read')->limit(10));

            if ($this->Auth->user('primary_role') == 3) {
                $this->Flash->error(__('Je bent verbannen!'));
                throw new ForbiddenException('Je bent verbannen');
            }

            if($user->hasPermission('mod_reports_index'))
            {
                $this->loadModel('Reports');

                $reports = $this->Reports->findByHandled(0)->select(['id']);
                if($reports->count() > 0) {
                    $this->Flash->default(__('Er zijn {0} ongelezen aangegeven berichten!', [
                        $reports->count()
                    ]));
                }
            }

        }
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), [
                'application/json',
                'application/xml'
            ])
        ) {
            $this->set('_serialize', true);
        }

        $this->viewBuilder()->theme('Musicplaza');
    }
}
