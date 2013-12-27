<?php

namespace Nox\Test\Controller;

use Nox\TestCase;
use Nox\Controller\Main;

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
