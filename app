#!/usr/bin/env php
<?php

use Illuminate\Console\Application;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

try {
    require_once __DIR__ . '/vendor/autoload.php';
    
    // $pdo = new PDO('mysql:host=0.0.0.0:3306;dbname=calculator', 'root', 'root');
    // var_dump($pdo);
    // require_once 'konek.php';

    $container = new Container();
    $dispatcher = new Dispatcher();
    $app = new Application($container, $dispatcher, '0.6');
    $app->setName('Calculator');

    $commands = require_once __DIR__ . '/commands.php';
    $commands = collect($commands)
        ->map(
            function ($command) use ($app) {
                return $app->getLaravel()->make($command);
            }
        )
        ->all()
    ;

    $app->addCommands($commands);

    $app->run(new ArgvInput(), new ConsoleOutput());
} catch (Throwable $e) {
    echo $e->getMessage();
}
