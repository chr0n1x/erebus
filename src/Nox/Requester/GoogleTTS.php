<?php

namespace Nox\Requester;

use Nox\Requester;

class GoogleTTS extends Requester {

  protected $_endpoints = array(
      '/translate_tts'
  );
  protected $_baseUrl = 'translate.google.com';

  /**
   * @array
   */
  protected $_queryParams = array(
      'ie'      => 'UTF-8',
      'total'   => 1,
      'tl'      => 'en',
      'idx'     => 0,
      'prev'    => 'input',
      'q'       => '',
      'textlen' => 0
  );

  public function textToSpeech( $text ) {

    $this->_queryParams['q']       = $text;
    $this->_queryParams['textlen'] = strlen( $text );

    $url = $this->_url . $this->_buildQueryStream( $this->_queryParams );

    return file_get_contents( $url );

  } // textToSpeech

} // Nox\Requester\GoogleTTS
