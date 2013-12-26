<?php

namespace Nox\Requester;

use Nox\Requester;
use TheSeer\fDOM\fDOMDocument;

class Wolfram extends Requester {

  const ERROR_MESSAGE = 'Wolfram Alpha returned an empty answer';

  protected $_protocol = 'http';
  protected $_endpoints = array(
      '/v2/query'
  );
  protected $_baseUrl = 'api.wolframalpha.com';

  /**
   * @array
   * Stores params that are used to build the query stream
   * Order matters!
   */
  protected $_queryParams = array(
      'appid'     => null,
      'format'    => 'plaintext',
      'podtitle'  => 'Result',
      'input'     => ''
  );

  public function ask( $query ) {

    $this->_queryParams['input'] = $query;

    $url = $this->_url . $this->_buildQueryStream( $this->_queryParams );
    $res = $this->get( $url )
                ->send();
    $res = (string)$res;

    return ( empty( $res ) )
           ? self::ERROR_MESSAGE
           : $this->_getPodPlaintext( $res );

  } // ask

  protected function _getPodPlaintext( $xml ) {

    $dom = new fDomDocument;

    try {
      $dom->loadXml( $xml );
    }
    catch ( \Exception $e ) {
      return self::ERROR_MESSAGE;
    }

    $nodes = $dom->getElementsByTagName( 'plaintext' );

    if ( count( $nodes ) <= 0 ) {
      return self::ERROR_MESSAGE;
    }

    // I hate XML
    // just because the Node element list is a Traversable
    foreach ( $nodes as $node ) {
      return $node->nodeValue;
    }

  } // _getPodPlaintext

} // Nox\Requester\Wolfram
