<?php

namespace Nox\Controller\V1;

use Nox\Controller;
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

    return new Response( $text, Response::HTTP_ACCEPTED );

  } // process

} // Nox\Controller\V1\Process
