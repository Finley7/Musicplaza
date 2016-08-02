<?php
namespace App\Controller;

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
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sections = $this->Sections->find('all')->contain(
            [
                'Forums' => [
                    'Subforums',
                    'Threads',
                ]
            ]
        );

        $threads = $this->Threads
            ->find('all')
            ->contain(['Lastposter' => ['PrimaryRole']])
            ->limit(10)
            ->sortBy('lastpost_date');

        $this->set('sections', $sections);
        $this->set('recent_threads', $threads);

        $this->set('title', 'Forum');
        $this->set('page_parent', 'community');
    }

    public function view($id = null)
    {
        if ($id == null) {
            throw new NotFoundException(__("Forum niet gevonden"));
        }

        $forum = $this->Forums->get($id, [
            'contain' => [
                'Subforums' => ['Threads'],
                'Threads' => [
                    'Lastposter' => ['PrimaryRole'],
                    'Users' => ['PrimaryRole']
                ]
            ]
        ]);

        $threads = $this->Threads
            ->find('all')
            ->contain(['Lastposter' => ['PrimaryRole']])
            ->limit(10)
            ->sortBy('lastpost_date');

        $this->set('recent_threads', $threads);

        $this->set('page_parent', 'community');
        $this->set('forum', $forum);
    }

}
