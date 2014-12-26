<?php
date_default_timezone_set('UTC');

require_once __DIR__.'/../bootstrap/constants.php';
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => EREBUS_VIEWS_DIR,
));
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => EREBUS_LOGS_DIR.'/all.log',
));

$configs = glob(EREBUS_CONFIG_DIR.'/*.json');
foreach ($configs as $file) {
    $app->register(new Igorw\Silex\ConfigServiceProvider($file));
}

$app->get('/', Erebus\Controller\Main::asView());
$app->get('/v1/ask', Erebus\Controller\V1\Ask::asView());
$app->get('/v1/audio', Erebus\Controller\V1\Audio::asView());
$app->run();
