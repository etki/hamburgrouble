<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi;

use Etki\Projects\Hamburgrouble\ApiClientBundle\Exception\InvalidResponseException;

/**
 * Response validator.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi
 * @author  Etki <etki@etki.name>
 */
class ResponseValidator
{
    /**
     * Validates API response.
     *
     * @param array $data Data to validate.
     *
     * @throws InvalidResponseException
     *
     * @return void
     * @since 0.1.0
     */
    public function validateResponse(array $data)
    {
        $violations = [];
        if (empty($data['date']) || !$data['date']) {
            $violations[] = 'Missing or incorrect `date` field';
        }
        if (empty($data['rates']) || !is_array($data['rates'])) {
            $violations[] = 'Missing or incorrect `rates` field';
        }
        if (empty($data['base']) || !$data['base']) {
            $violations[] = 'Missing or incorrect `base` field';
        }
        if ($violations) {
            throw new InvalidResponseException(implode(PHP_EOL, $violations));
        }
    }
}
