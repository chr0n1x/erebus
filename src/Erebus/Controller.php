<?php

namespace Erebus;

use SilexView\TemplateView;

/**
 * Erebus\Controller
 * Base wrapper for SilexView\TemplateView
 */
class Controller extends TemplateView
{
    /**
     * @param   Symfony\Component\HttpFoundation\Request
     * @param   Silex\Application
     * @return  array
     * @throws  \Exception
     */
    public function getContextData($request, $app)
    {
        throw new \RuntimeException(
            __FUNCTION__.' must be implemented & must return an array!'
        );
    }
}
