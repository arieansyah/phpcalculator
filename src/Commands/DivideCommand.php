<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\Core;


class DivideCommand extends Core
{
    public function __construct()
    {
        $this->operator = '/';
        $this->command = 'devide';
        $this->description = "divide all given numbers";

        //argument must be array
        $this->argument = ['numbers* : The numbers to be divided'];
        parent::__construct();
    }
}
