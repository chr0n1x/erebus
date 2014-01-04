<?php
error_reporting( E_ALL );

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('Erebus\Test', __DIR__);

require __DIR__.'/Erebus/TestCase.php';
