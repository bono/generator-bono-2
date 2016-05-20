<?php

require '../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\ChromePHPHandler;
use Monolog\Handler\ErrorLogHandler;

// define logger programmatically
$logger = (new Logger('bono'))
    ->pushHandler(new ChromePHPHandler()) // nice chrome logger for monolog
    ->pushHandler(new ErrorLogHandler()); // this one will log to web server errlog

Bono\App::getInstance()->addLogger('default', $logger)->run();
