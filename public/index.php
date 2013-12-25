<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/all.log',
));

$app->get('/', Nox\Controller\Main::asView());
$app->post('/v1/process', Nox\Controller\V1\Process::asView());
$app->run();
