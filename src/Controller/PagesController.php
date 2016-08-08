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

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * @param Event $event
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['landing']);
    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function landing()
    {
        $this->set('title', __('Welkom op VinylVinder!'));
        $this->loadModel('Friends');
        $this->loadModel('Timeline');

        $friendFinder = $this->Friends->find('friends', [
            'user_id' => $this->Auth->user('id')
        ])->contain(
            [
                'FriendOne' => [
                    'Timeline' => [
                        'Wows',
                        'Users' => [
                            'PrimaryRole'
                        ]
                    ]
                ],
                'FriendTwo' => [
                    'Timeline' => [
                        'Wows',
                        'Users' => [
                            'PrimaryRole'
                        ]
                    ]
                ]
            ]
        )->where([
            'status' => 'accepted'
        ]);

        $i = 0;
        $timeline = [];

        foreach($friendFinder->all() as $friend) {
            $a = 0;

            if($friend->user_one == $this->Auth->user('id')) {
                foreach($friend->friend_two->timeline as $timelines) {
                    $timeline[$i][$a] = $timelines;
                    $a++;
                }
            }
            else
            {
                foreach($friend->friend_one->timeline as $timelines) {
                    $timeline[$i][$a] = $timelines;
                    $a++;
                }
            }

            $i++;
        }

        $myTimeline = $this->Timeline->findByUserId($this->Auth->user('id'))->contain(['Wows', 'Users' => ['PrimaryRole']])->order('created')->limit(5);

        $threads = $this->Threads
            ->find('all')
            ->contain(['Lastposter' => ['PrimaryRole']])
            ->limit(10)
            ->sortBy('lastpost_date');

        $this->set(compact('myTimeline'));
        $this->set('timelines', $timeline);
        $this->set('recent_threads', $threads);
        $this->set('page_parent', 'home');

    }

    public function chat() {
        $this->loadModel('Users');
        $this->loadModel('Chats');

        $users = $this->Users->find('all')->select('id')->count();
        $chats = $this->Chats->find('all')->select('id')->count();

        $this->set(compact('users', 'chats'));

        $this->set('title', __('Chatbox'));
    }
}
