<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\Core;

class SubtractCommand extends Core
{
    public function __construct()
    {
        $this->operator = '-';
        $this->command = 'subtract';

        $this->description = "subtract all given numbers";

        //argument must be array
        $this->argument = ['numbers* : The numbers to be subtracted'];
        parent::__construct();
    }
}
