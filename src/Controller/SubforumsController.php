<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subforums Controller
 *
 * @property \App\Model\Table\SubforumsTable $Subforums
 */
class SubforumsController extends AppController
{


    /**
     * View method
     *
     * @param string|null $id Subforum id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subforum = $this->Subforums->get($id, ['contain' => ['Forums']]);

        $threads = $this->Threads->findBySubforumId($subforum->id)->contain([
            'Forums',
            'Users' => ['PrimaryRole'],
            'Subforums',
            'Lastposter' => ['PrimaryRole'],
            'Comments' => [
                'Users' => ['PrimaryRole'],
                'Threads'
            ]
        ]);

        $this->paginate = [
            'limit' => 12,
            'contain' => ['Users' => ['PrimaryRole']]
        ];

        $recent_threads = $this->Threads
            ->find('all')
            ->contain(['Lastposter' => ['PrimaryRole']])
            ->limit(10)
            ->sortBy('lastpost_date');

        $this->set('recent_threads', $recent_threads);

        $this->set(compact('subforum'));
        $this->set('page_parent', 'community');
        $this->set('threads', $this->paginate($threads));
        $this->set('_serialize', ['subforum']);
    }

}
