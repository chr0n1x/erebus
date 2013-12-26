<?php

namespace Nox;

use Httpful\Http;

abstract class Requester {

  /**
   * @string
   */
  protected $_protocol    = 'https';

  /**
   * @array
   * known endpoints for the extending class.
   * must have a '/' preceding it
   */
  protected $_endpoints   = array();

  /**
   * @array
   * Stores params that are used to build the query stream
   * Order matters!
   */
  protected $_queryParams = array();

  /**
   * @string
   * set once in constructor and that's it
   */
  protected $_baseUrl;

  /**
   * @string
   * Convenience instance var for building out endpoint URLs
   */
  protected $_url;

  /**
   * @array
   * Initialized in contructor
   * Methods that are allowed to be used with Httpful\Request
   */
  private $_methods;

  /**
   * @param  string      $endpoint   Cross-checked with $this->_endpoints
   * @param  array       $cfg        Anything special that needs to be merged
   *                                 into $this->_queryParams
   * @throws \Exception              When the endpoint url is invalid
   */
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

  /**
   * @param   string  $fx   HTTP method
   * @param   array   $args
   * @return  Httpful\Response
   * @throws  \Exception    When $fx is unknown
   */
  public function __call( $fx, $args ) {

    if ( !in_array( $fx, $this->_methods ) ) {
      throw new \Exception( "Unknown method [{$fx}]" );
    }

    return call_user_func_array( array( 'Httpful\Request', $fx ), $args );

  } // __call

  /**
   * @param  array $params  Keys = variable names, Values = values
   * @return string
   */
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

  /**
   * @param  string     $endpoint
   * @return string
   * @throws \Exception
   */
  protected function _buildEndpointUrl( $endpoint ) {

    if ( !in_array( $endpoint, $this->_endpoints ) ) {
      throw new \Exception( "Unknown endpoint {$endpoint}" );
    }

    return $this->_baseUrl . $endpoint;

  } // _buildEndpointUrl

} // Nox\Requester
