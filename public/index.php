<?php

require_once __DIR__.'/../bootstrap/constants.php';
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => Erebus_VIEWS_DIR
));
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => Erebus_LOGS_DIR . '/all.log'
));

$configs = glob( Erebus_CONFIG_DIR . '/*.json' );
foreach ( $configs as $file ) {
  $app->register( new Igorw\Silex\ConfigServiceProvider( $file ) );
}

$app->get('/', Erebus\Controller\Main::asView());
$app->get('/v1/process', Erebus\Controller\V1\Process::asView());
$app->run();
