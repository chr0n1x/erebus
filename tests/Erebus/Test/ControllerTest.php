<?php

namespace Erebus\Test;

use Erebus\TestCase;
use Erebus\Controller;

class ControllerTest extends TestCase
{
    /**
   * @test
   * @expectedException \Exception
   */
    public function contextDataMustBeOverwritten()
    {
        (new Controller())->getContextData($this->_request, $this->_app);
    } // contextDataMustBeOverwritten
}
