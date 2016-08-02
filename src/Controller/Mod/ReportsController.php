<?php
namespace App\Controller\Mod;

use App\Controller\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'limit' => 25
        ];

        $reports = $this->Reports->find('all')->contain([
            'Comments',
            'Threads',
            'Handler',
            'Reporter'
        ])->orderAsc('handled');

        $this->set('reports', $this->paginate($reports));
        $this->set('page_parent', 'mod');
    }

    public function view($id = null)
    {
        $report = $this->Reports->get($id, ['contain' => [
            'Comments',
            'Threads',
            'Handler',
            'Reporter',
        ]]);

        if($this->request->is('post')){
            $report->handled = 1;
            $report->handled_by = $this->Auth->user('id');

            if($this->Reports->save($report)) {
                $this->Flash->success(__('Bericht #{0} is gemarkeerd als gelezen', $report->id));
                return $this->redirect(['controller' => 'Reports', 'action' => 'index', 'prefix' => 'mod']);
            }
            else
            {
                $this->Flash->error(__('Er is iets fout gegaan!'));
            }
        }

        $this->set('page_parent', 'mod');
        $this->set('report', $report);
    }
}
