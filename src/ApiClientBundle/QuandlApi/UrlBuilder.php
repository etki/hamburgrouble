<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi;

/**
 * Builds URLs.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi
 * @author  Etki <etki@etki.name>
 */
class UrlBuilder
{
    const DATASET_URL_FORMAT = '%s://%s/api/v3/datasets/BLS/%s.%s';
    /**
     * Default host to use.
     *
     * @since 0.1.0
     */
    const DEFAULT_HOST = 'www.quandl.com';

    /**
     * Host to use.
     *
     * @type string
     * @since 0.1.0
     */
    private $host;
    /**
     * Whether to use HTTPS or not.
     *
     * @type bool
     * @since 0.1.0
     */
    private $useHttps;

    /**
     * Initializer.
     *
     * @param string $host     Host to use.
     * @param bool   $useHttps HTTPS usage policy.
     *
     * @since 0.1.0
     */
    public function __construct($host = self::DEFAULT_HOST, $useHttps = true)
    {
        $this->host = $host;
        $this->useHttps = $useHttps;
    }

    /**
     * Creates URL for particular data set.
     *
     * @param string $dataSetId ID of the data set.
     * @param string $format    Format to return data set in.
     *
     * @return string
     * @since 0.1.0
     */
    public function getDataSetUrl($dataSetId, $format = 'json')
    {
        $url = sprintf(
            self::DATASET_URL_FORMAT,
            $this->useHttps ? 'https' : 'http',
            $this->host,
            $dataSetId,
            $format
        );
        return $url;
    }
}
