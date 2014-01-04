<?php

namespace Erebus\Controller;

use Erebus\Controller;

class Main extends Controller {

  const ACTION = 'v1/process';

  /**
   * {@inheritDoc}
   */
  function getContextData( $request, $app ) {

    return array( 'action' => self::ACTION );

  } // getContextData

} // Erebus\Controller\Main
