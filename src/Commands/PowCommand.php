<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\Core;

class PowCommand extends Core
{
    public function __construct()
    {
        $this->operator = '^';
        $this->command = 'pow';

        $this->description = "exponent all given numbers";

        //argument must be array
        $this->argument = [
            'base : the base number',
            'exp : the exponent number',
        ];
        parent::__construct();
    }
}
