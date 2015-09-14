<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi;

use GuzzleHttp\Client as Guzzle;
use Psr\Log\LoggerInterface;

/**
 * Quandl API client.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi
 * @author  Etki <etki@etki.name>
 */
class Client
{
    /**
     * Guzzle client.
     *
     * @type Guzzle
     * @since 0.1.0
     */
    private $guzzle;
    /**
     * Logger instance.
     *
     * @type LoggerInterface
     * @since 0.1.0
     */
    private $logger;
    /**
     * URL builder instance.
     *
     * @type UrlBuilder
     * @since 0.1.0
     */
    private $urlBuilder;

    /**
     * Initializer.
     *
     * @param Guzzle          $guzzle     Guzzle client instance.
     * @param LoggerInterface $logger     Logger instance.
     * @param UrlBuilder      $urlBuilder URL generator.
     *
     * @since 0.1.0
     */
    public function __construct(
        Guzzle $guzzle,
        LoggerInterface $logger,
        UrlBuilder $urlBuilder = null
    ) {
        $this->guzzle = $guzzle;
        $this->logger = $logger;
        $this->urlBuilder = $urlBuilder ?: new UrlBuilder();
    }

    /**
     * Returns response with required data set.
     *
     * @param string $dataSetId Data set ID.
     *
     * @return Response
     * @since 0.1.0
     */
    public function getDataSet($dataSetId)
    {
        $url = $this->urlBuilder->getDataSetUrl($dataSetId);
        $rawResponse = $this->guzzle->get($url);
        $response = (new ResponseDeserializer)->deserialize($rawResponse);
        return (new ResponseDataSetExtractor)->extract($response);
    }
}
