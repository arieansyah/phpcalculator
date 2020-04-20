<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\Core;

class AddCommand extends Core
{
    public function __construct()
    {
        $this->operator = '+';
        $this->command = 'add';
        $this->description = "add all given numbers";

        //argument must be array
        $this->argument = ['numbers* : The numbers to be added'];
        parent::__construct();
    }
}
