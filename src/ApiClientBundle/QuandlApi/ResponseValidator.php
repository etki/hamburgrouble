<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi;

use Etki\Projects\Hamburgrouble\ApiClientBundle\Exception\InvalidResponseException;

/**
 * Validates responses (what, really?)
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi
 * @author  Etki <etki@etki.name>
 */
class ResponseValidator
{
    /**
     * Validates response.
     *
     * @param array $response Response to validate.
     *
     * @throws InvalidResponseException
     *
     * @return void
     * @since 0.1.0
     */
    public function validate(array $response)
    {
        // no proper abstraction, as always
        $violations = [];
        if (empty($response['column_names'])
            || !is_array($response['column_names'])
        ) {
            $violations[] = 'Response `column_names` field isn\'t specified ' .
                'or has wrong type';
        }
        if (empty($response['data'])
            || !is_array($response['data'])
        ) {
            $violations[] = 'Response `data` field isn\'t specified or has ' .
                'wrong type';
        }
        if (empty($response['refreshed_at'])) {
            $violations[] = 'Response `refreshed_at` field isn\'t specified';
        }
        if ($violations) {
            throw new InvalidResponseException(implode(PHP_EOL, $violations));
        }
    }
}
