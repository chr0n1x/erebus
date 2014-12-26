<?php

namespace Erebus\Controller\V1;

use Erebus\Controller;
use Erebus\Requester\GoogleTTS;
use Nyx\Requester\Wolfram;
use Silex\Application;
use SilexView\BaseView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Process extends BaseView
{
    const PARAM = 'speechinput';

    /**
   * {@inheritDoc}
   */
    public function get(Request $req, Application $app)
    {
        $text = $req->get(self::PARAM);

        $app['monolog']->addInfo("Query: [ {$text} ]");

        try {
            $res = (new Wolfram($app['wolfram']))->ask($text);
        } catch (\InvalidArgumentException $e) {
            $res = 'I do not have a valid wolfram configuration, please fix that and ask again';
        }

        if (empty($res)) {
            $res = "Sorry, I couldn't find a short answer for that question. Google it.";
        }

        $app['monolog']->addInfo("Response: [ {$res} ]");

        $audio = (new GoogleTTS())->textToSpeech($res);

        $response = new Response($audio, Response::HTTP_OK);

        $response->headers->set('Content-Type', 'audio/mpeg');
        $response->headers->set('Cache-Control', 'no-cache');

        return $response;
    } // process
}
