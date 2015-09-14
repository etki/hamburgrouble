<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi;

/**
 * What a useless class.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi
 * @author  Etki <etki@etki.name>
 */
class ResponseDataSetExtractor
{
    /**
     * Extracts response data set.
     *
     * @param Response $response Response instance.
     *
     * @return DataSet
     * @since 0.1.0
     */
    public function extract(Response $response)
    {
        $dataSet = new DataSet(
            $response->getDataSet(),
            $response->getColumnNames(),
            $response->getRefreshedAt()
        );
        return $dataSet;
    }
}
