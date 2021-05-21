<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use HPT\CZC\Grabber;
use HPT\CZC\Output;
use HPT\Dispatcher;

$dispatcher = new Dispatcher(new Grabber(), new Output());
echo $dispatcher->run('vstup.txt');
