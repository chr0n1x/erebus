<?php

namespace Nox;

use Httpful\Http;

abstract class Requester {

  protected $_protocol    = 'https';
  protected $_endpoints   = array();
  protected $_queryParams = array();
  protected $_baseUrl;
  protected $_url;

  private $_methods;

  public function __construct( $endpoint, $cfg = array() ) {

    $this->_baseUrl = $this->_protocol.'://'.$this->_baseUrl;

    if ( empty( $this->_baseUrl ) ) {
      throw new \Exception( "Invalid URL: {$this->_baseUrl}" );
    }

    $methods = array_merge( Http::safeMethods(), Http::idempotentMethods() );
    $methods = array_map( 'strtolower', $methods );

    $this->_methods     = $methods;
    $this->_url         = $this->_buildEndpointUrl( $endpoint );
    $this->_queryParams = array_merge( $this->_queryParams, $cfg );

  } // __construct

  public function __call( $fx, $args ) {

    if ( !in_array( $fx, $this->_methods ) ) {
      throw new \Exception( "Unknown method [{$fx}]" );
    }

    return call_user_func_array( array( 'Httpful\Request', $fx ), $args );

  } // __call

  protected function _buildQueryStream( array $params ) {

    if ( empty( $params ) ) {
      return '';
    }

    $first = key( $params );
    $query = '?' . $first . '=' . current( $params );

    unset( $params[ $first ] );

    foreach( $params as $param => $val ) {
      $param  = urlencode( $param );
      $val    = urlencode( $val );
      $query .= "&{$param}={$val}";
    }

    return $query;

  } // _buildQueryStream

  protected function _buildEndpointUrl( $endpoint ) {

    if ( !in_array( $endpoint, $this->_endpoints ) ) {
      throw new \Exception( "Unknown endpoint {$endpoint}" );
    }

    return $this->_baseUrl . $endpoint;

  } // _buildEndpointUrl

} // Nox\Requester
