<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Client;

/**
 * Bol component
 */
class BolComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function newTracks() {

        $apiClient = new Client('58646A597E4D48D7BC5F6EA0F4DA9B62');
        $response = $apiClient->getLists('', '8079,8082,14033,3132,7290', '', 100);

        return $response;
    }

    public function trackInfo($bol_id){
        $apiClient = new Client('58646A597E4D48D7BC5F6EA0F4DA9B62');

        return $apiClient->getProduct($bol_id);
    }

    public function search($search_string, $limit = 10)
    {
        $apiClient = new Client('58646A597E4D48D7BC5F6EA0F4DA9B62');
        $srccodes = '8079,8082,14033,3132,8342';
        $response = $apiClient->getSearch($search_string, $srccodes, '', '', $limit, null, null, null, null, null);

        return $response;
    }
}
