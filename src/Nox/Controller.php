<?php

namespace Nox;

use SilexView\TemplateView;

/**
 * Nox\Controller
 * Base wrapper for SilexView\TemplateView
 */
abstract class Controller extends TemplateView {

  /**
   * @param   Symfony\Component\HttpFoundation\Request
   * @param   Silex\Application
   * @return  array
   * @throws  \Exception
   */
  function getContextData( $request, $app ) {

    throw new \Exception( __FUNCTION__ . ' must be implemented & must return an array!' );

  } // getContextData

} // Nox\Controller
