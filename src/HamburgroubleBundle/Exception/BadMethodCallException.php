<?php

namespace Etki\Projects\Hamburgrouble\HamburgroubleBundle\Exception;

use BadMethodCallException as SplBadMethodCallException;

/**
 * Base bad method call exception.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\HamburgroubleBundle\Exception
 * @author  Etki <etki@etki.name>
 */
class BadMethodCallException extends SplBadMethodCallException implements
    HamburgroubleBundleExceptionInterface
{
}
