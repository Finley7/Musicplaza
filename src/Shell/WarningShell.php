<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\I18n\Time;

/**
 * Warning shell command.
 */
class WarningShell extends Shell
{

    public function initialize()
    {
        $this->loadModel('Warnings');
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() 
    {
        $this->out("Checking if warnings have to be lifted..");
        $warnings = $this->Warnings->findByExpired(0);

        $warning_ids = [];

        foreach($warnings as $warning)
        {
            if($warning->expires < Time::now()) {
                $warning_ids[] = $warning->id;
            }
        }

        foreach($warning_ids as $warning)
        {
            $warning = $this->Warnings->get($warning);

            $warning->expired = 1;

            if($this->Warnings->save($warning)) {
                $this->success('Marked waring as expired');
            }
            else
            {
                $this->err('Cannot mark as expired');
            }
        }


        $this->success("Succesfully lifted " . count($warning_ids) . " warnings");

    }
}
