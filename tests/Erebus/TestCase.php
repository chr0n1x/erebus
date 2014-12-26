<?php

namespace Erebus;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $_request;
    protected $_app;

    protected function setUp()
    {
        $this->_request = new Request();
        $this->_app     = new Application();
    } // setUp
}
