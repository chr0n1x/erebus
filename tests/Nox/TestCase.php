<?php

namespace Nox;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

class TestCase extends \PHPUnit_Framework_TestCase {

  protected $_request,
            $_app;

  protected function setUp() {

    $this->_request = new Request;
    $this->_app     = new Application;

  } // setUp

} // TestCase
