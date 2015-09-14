<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi;

use DateTimeInterface;

/**
 * Builds URLs.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi
 * @author  Etki <etki@etki.name>
 */
class UrlBuilder
{
    /**
     * Default date to use.
     *
     * @since 0.1.0
     */
    const DEFAULT_DATE = 'latest';
    /**
     * Default API host.
     *
     * @since 0.1.0
     */
    const DEFAULT_HOST = 'api.fixer.io';

    /**
     * Host to use.
     *
     * @type string
     * @since 0.1.0
     */
    private $host;

    /**
     * Initializer.
     *
     * @param string $host Host to use.
     *
     * @since 0.1.0
     */
    public function __construct($host = self::DEFAULT_HOST)
    {
        $this->host = $host;
    }

    /**
     * Creates url for particular rate conversion.
     *
     * @param string|DateTimeInterface $date             Date to fetch rates
     *                                                   for.
     * @param string                   $baseCurrency     Base currency to fetch
     *                                                   rates for.
     * @param string[]                 $targetCurrencies List of currencies to
     *                                                   fetch conversion rates
     *                                                   for.
     *
     * @return string
     * @since 0.1.0
     */
    public function getRateConversionUrl(
        $date,
        $baseCurrency = null,
        array $targetCurrencies = null
    ) {
        if ($date instanceof DateTimeInterface) {
            $date = $date->format('Y-m-d');
        } else if (!$date) {
            $date = self::DEFAULT_DATE;
        }
        $url = 'http://' . self::DEFAULT_HOST . '/' . $date;
        $context = [];
        if ($baseCurrency) {
            $context['base'] = $baseCurrency;
        }
        if ($targetCurrencies) {
            $context['symbols'] = implode(',', $targetCurrencies);
        }
        if ($context) {
            $url .= '?' . http_build_query($context);
        }
        return $url;
    }
}
