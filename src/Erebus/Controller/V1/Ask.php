<?php

namespace Erebus\Controller\V1;

use Nyx\Requester\Wolfram;
use Silex\Application;
use SilexView\BaseView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Ask extends BaseView
{
    /**
     * {@inheritDoc}
     */
    public function get(Request $req, Application $app)
    {
        $text = $req->get('speechinput');
        $app['monolog']->addInfo("Query: [ {$text} ]");
        $res = $this->getAnswer($text, $app);
        $app['monolog']->addInfo("Response: [ {$res} ]");

        $res = json_encode(array('query' => $text, 'response' => $res));
        $response = new Response($res, Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    protected function getAnswer($query, Application $app)
    {
        try {
            $res = (new Wolfram($app['wolfram']))->ask($query);
        } catch (\InvalidArgumentException $e) {
            $res = 'I do not have a valid wolfram configuration.';
        }

        if (empty($res)) {
            $res = "Sorry, I couldn't find an answer for that question.";
        }

        return $res;
    }
}
