<?php

namespace Nox\Test;

use Nox\TestCase;
use Nox\Controller;

class ControllerTest extends TestCase {

  /**
   * @test
   * @expectedException \Exception
   */
  public function contextDataMustBeOverwritten() {

    ( new Controller )->getContextData( $this->_request, $this->_app );

  } // cannotInstantiate

} // ControllerTest
