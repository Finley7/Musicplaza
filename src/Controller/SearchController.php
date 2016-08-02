<?php
namespace App\Controller;

use App\Controller\AppController;

class SearchController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        if($this->request->is('get'))
        {
            if(isset($_GET['search_string']) && strlen($_GET['search_string']) > 4) {
                $results = $this->Bol->search(h($_GET['search_string']), 25);
                $this->set('records', $results);
            }
        }

        $this->set('title', __('Platen zoeken'));
        $this->set('page_parent', 'search');
    }

}
