<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\Exception;

use RuntimeException;

/**
 * Generic API exception.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\Exception
 * @author  Etki <etki@etki.name>
 */
class ApiException extends RuntimeException implements
    ApiBundleExceptionInterface
{

}
