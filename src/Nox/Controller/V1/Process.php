<?php

namespace Nox\Controller\V1;

use Nox\Controller;
use Nox\Requester\GoogleTTS;
use Nox\Requester\Wolfram;
use Silex\Application;
use SilexView\BaseView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Process extends BaseView {

  const PARAM = 'speechinput';

  /**
   * {@inheritDoc}
   */
  function get( Request $req, Application $app ) {

    $text = $req->get( self::PARAM );

    $app['monolog']->addInfo( "Query: [ {$text} ]" );

    $res = ( new Wolfram( '/v2/query' ) )
           ->ask( $text );

    if ( empty( $res ) ) {
      $res = 'Wolfram alpha failed to return a response, sorry.';
    }

    $app['monolog']->addInfo( "Response: [ {$res} ]" );

    $audio = ( new GoogleTTS( '/translate_tts' ) )
             ->textToSpeech( $res );

    $response = new Response( $audio, Response::HTTP_OK );

    $response->headers->set( 'Content-Type', 'audio/mpeg' );
    $response->headers->set( 'Cache-Control', 'no-cache' );

    return $response;

  } // process

} // Nox\Controller\V1\Process
