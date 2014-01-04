<?php

namespace Erebus\Test\Controller;

use Erebus\TestCase;
use Erebus\Controller\Main;

class MainTest extends TestCase {

  /**
   * @test
   */
  public function contextDataReturnsAction() {

    $data = ( new Main )->getContextData( $this->_request, $this->_app );

    $this->assertInternalType( 'array', $data );
    $this->assertArrayHasKey( 'action', $data );

  } // contextDataReturnsAction

} // MainTest
