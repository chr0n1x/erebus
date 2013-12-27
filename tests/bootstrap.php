<?php
error_reporting( E_ALL );

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('Nox\Test', __DIR__);

require __DIR__.'/Nox/TestCase.php';
