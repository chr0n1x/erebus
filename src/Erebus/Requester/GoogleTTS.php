<?php

namespace Erebus\Requester;

use Nyx\Requester;

class GoogleTTS extends Requester
{
    const TRANSLATE_EP = '/translate_tts';

    protected $_endpoints = array(
      self::TRANSLATE_EP,
    );
    protected $_baseUrl = 'translate.google.com';

    /**
     * @array
     */
    protected $_queryParams = array(
      'tl'      => 'en',
      'q'       => '',
    );

    public function textToSpeech($text)
    {
        $this->_queryParams['q']       = $text;
        $this->_queryParams['textlen'] = strlen($text);

        $url = $this->_buildRequestUrl(self::TRANSLATE_EP);

        return file_get_contents($url);
    }
}
