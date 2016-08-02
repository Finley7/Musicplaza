<?php
namespace App\Shell;

use Cake\Console\Shell;

/**
 * Bans shell command.
 */
class BansShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main()
    {
        $this->loadModel('Bans');
        $this->out('Removing old bans');
        $bansQuery = $this->Bans->find('all')->where(['expires <= ' => new \DateTime('now'), 'expires is not' => null]);
        foreach ($bansQuery->all() as $ban)
        {
            $this->Bans->delete($ban);
        }
    }
}
