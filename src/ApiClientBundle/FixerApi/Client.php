<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi;

use Etki\Projects\Hamburgrouble\ApiClientBundle\Exception\InvalidResponseException;
use GuzzleHttp\Client as Guzzle;
use Psr\Log\LoggerInterface;

/**
 * Fixer API client.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi
 * @author  Etki <etki@etki.name>
 */
class Client
{
    const HOST = 'api.fixer.io';
    /**
     * Guzzle instance.
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
     * URL builder.
     *
     * @type UrlBuilder
     * @since 0.1.0
     */
    private $urlBuilder;
    /**
     * Response validator.
     *
     * @type ResponseValidator
     * @since 0.1.0
     */
    private $responseValidator;
    /**
     * Response converter.
     *
     * @type ResponseConverter
     * @since 0.1.0
     */
    private $responseConverter;

    /**
     * Initializer.
     *
     * @param Guzzle          $guzzle Guzzle client.
     * @param LoggerInterface $logger Logger instance.
     *
     * @since 0.1.0
     */
    public function __construct(Guzzle $guzzle, LoggerInterface $logger)
    {
        $this->guzzle = $guzzle;
        $this->logger = $logger;
        $this->urlBuilder = new UrlBuilder;
        $this->responseConverter = new ResponseConverter;
        $this->responseValidator = new ResponseValidator;
    }

    /**
     * Fetches rates for particular currencies.
     *
     * @param string   $baseCurrency     Base currency to fetch rates for.
     * @param string[] $targetCurrencies Currencies to fetch conversion rates
     *                                   for.
     * @param string   $date             Date to fetch rates for.
     *
     * @return Rate[]
     * @since 0.1.0
     */
    public function getRates(
        $baseCurrency,
        array $targetCurrencies,
        $date = 'latest'
    ) {
        $this->logger->debug(
            'Fetching rates for {currency}:{currencies} for {date}',
            [
                'currency' => $baseCurrency,
                'currencies' => $targetCurrencies,
                'date' => $date
            ]
        );
        $rateUrl = $this->urlBuilder->getRateConversionUrl(
            $date,
            $baseCurrency,
            $targetCurrencies
        );
        $response = $this->guzzle->get($rateUrl);
        $data = json_decode($response->getBody()->getContents(), true);
        if (!$data) {
            throw new InvalidResponseException('Malformed response');
        }
        $this->responseValidator->validateResponse($data);
        return $this->responseConverter->convert($data);
    }
}
