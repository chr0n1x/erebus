<?php

namespace Nox\Controller;

use Nox\Controller;

class Main extends Controller {

  const ACTION = 'process';

  /**
   * {@inheritDoc}
   */
  function getContextData( $request, $app ) {

    return array( 'action' => self::ACTION );

  } // getContextData

} // Nox\Controller\Main
