<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/simplehtmldom/simplehtmldom/simple_html_dom.php';

use HPT\CZC\Grabber;
use HPT\CZC\Output;
use HPT\Dispatcher;

$dispatcher = new Dispatcher(new Grabber(), new Output());
echo $dispatcher->run('vstup.txt');
