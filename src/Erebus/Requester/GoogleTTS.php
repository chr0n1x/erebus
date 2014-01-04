<?php

namespace Erebus\Requester;

use Erebus\Requester;

class GoogleTTS extends Requester {

  const TRANSLATE_EP = '/translate_tts';

  protected $_endpoints = array(
      self::TRANSLATE_EP
  );
  protected $_baseUrl = 'translate.google.com';

  /**
   * @array
   */
  protected $_queryParams = array(
      'tl'      => 'en',
      'q'       => ''
  );

  public function textToSpeech( $text ) {

    $this->_queryParams['q']       = $text;
    $this->_queryParams['textlen'] = strlen( $text );

    $url = $this->_buildEndpointUrl( self::TRANSLATE_EP )
           . $this->_buildQueryStream( $this->_queryParams );

    return file_get_contents( $url );

  } // textToSpeech

} // Erebus\Requester\GoogleTTS
