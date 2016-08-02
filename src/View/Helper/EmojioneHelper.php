<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Emojione\Client;
use Emojione\Emojione;
use Emojione\Ruleset;

/**
 * Emojione helper
 */
class EmojioneHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @return void
     * */
    public function configure($type = 'svg') {
        Emojione::$imageType = $type;
    }

    public function smiley($text)
    {
        return Emojione::unicodeToImage($text);
    }

    public function emo($text)
    {
        $client = new Client(new Ruleset());
        $client->imageType = 'svg';
        return $client->toImage($text);
    }


}
