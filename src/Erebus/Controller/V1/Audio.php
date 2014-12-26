<?php

namespace Erebus\Controller\V1;

use Erebus\Requester\GoogleTTS;
use Silex\Application;
use SilexView\BaseView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Audio extends BaseView
{
    /**
     * {@inheritDoc}
     */
    public function get(Request $req, Application $app)
    {
        $audio = $this->buildAudio($req->get('text'));
        $res = json_encode(array('audio' => $audio));

        $response = new Response($res, Response::HTTP_OK);
        $response->headers->set('Content-Type', 'audio/mpeg');
        $response->headers->set('Cache-Control', 'no-cache');

        return $response;
    }

    protected function buildAudio($text)
    {
        return (new GoogleTTS())->textToSpeech($text);
    }
}
