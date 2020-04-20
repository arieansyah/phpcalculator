<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\Core;

class MultiplyCommand extends Core
{
    public function __construct()
    {
        $this->operator = '*';
        $this->command = 'multiply';
        $this->description = "multiply all given numbers";

        //argument must be array
        $this->argument = ['numbers* : The numbers to be multiplied'];
        parent::__construct();
    }
}
