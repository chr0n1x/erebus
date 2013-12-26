<?php

namespace Nox\Controller\V1;

use Nox\Controller;
use Nox\Requester\Wolfram;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Process extends Controller {

  const PARAM = 'speechinput';

  /**
   * {@inheritDoc}
   */
  function post( Request $req, Application $app ) {

    $text = $req->get( self::PARAM );

    $app['monolog']->addInfo( "input query '{$text}'" );

    $res = ( new Wolfram( '/v2/query' ) )
           ->ask( $text );

    $app['monolog']->addInfo( "Question asked: [ {$text} ], Response: [ {$res} ]; getting audio ..." );

    return new Response( $res, Response::HTTP_OK );

  } // process

} // Nox\Controller\V1\Process
