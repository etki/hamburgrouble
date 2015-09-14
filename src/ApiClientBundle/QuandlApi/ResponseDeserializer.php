<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi;

use DateTimeImmutable;
use Etki\Projects\Hamburgrouble\ApiClientBundle\Exception\InvalidResponseException;

/**
 * Not an object mapper, sry.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi
 * @author  Etki <etki@etki.name>
 */
class ResponseDeserializer
{
    /**
     * Response validator instance.
     *
     * @type ResponseValidator
     * @since 0.1.0
     */
    private $responseValidator;

    /**
     * Initializer.
     *
     * @param ResponseValidator $responseValidator Response validator.
     *
     * @since 0.1.0
     */
    public function __construct(ResponseValidator $responseValidator = null)
    {
        $this->responseValidator = $responseValidator ?: new ResponseValidator;
    }


    /**
     * Deserializes response.
     *
     * @param string $data   Encoded data.
     * @param string $format Encoding format.
     *
     * @throws InvalidResponseException
     *
     * @return Response
     * @since 0.1.0
     */
    public function deserialize($data, $format = 'json')
    {
        // disregard the format lol
        $deserialized = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidResponseException('Unreadable response');
        }
        $this->responseValidator->validate($deserialized);
        $response = new Response;
        $response->setColumnNames($deserialized['column_names']);
        $response->setDataSet($deserialized['data']);
        $response->setRefreshedAt(
            new DateTimeImmutable($deserialized['refreshed_at'])
        );
        return $response;
    }
}
