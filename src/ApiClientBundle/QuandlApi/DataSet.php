<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi;

use DateTimeInterface;

/**
 * This class represents single data set from Quandl response.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi
 * @author  Etki <etki@etki.name>
 */
class DataSet
{
    /**
     * Raw data.
     *
     * @type array
     * @since 0.1.0
     */
    private $dataSet;
    /**
     * Column names.
     *
     * @type string[]
     * @since 0.1.0
     */
    private $columns;
    /**
     * Last update.
     *
     * @type DateTimeInterface
     * @since 0.1.0
     */
    private $updatedAt;

    /**
     * Initializer.
     *
     * @param array             $dataSet    Data.
     * @param string[]          $columns    Data columns.
     * @param DateTimeInterface $lastUpdate Last update timestamp.
     *
     * @since 0.1.0
     */
    public function __construct(
        array $dataSet,
        array $columns,
        DateTimeInterface $lastUpdate
    ) {
        $this->dataSet = $dataSet;
        $this->columns = $columns;
        $this->updatedAt = $lastUpdate;
    }

    /**
     * Returns raw data.
     *
     * @return array
     * @since 0.1.0
     */
    public function getDataSet()
    {
        return $this->dataSet;
    }

    /**
     * Returns columns.
     *
     * @return string[]
     * @since 0.1.0
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Returns last update timestamp.
     *
     * @return DateTimeInterface
     * @since 0.1.0
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Returns complete data set.
     *
     * @return array
     * @since 0.1.0
     */
    public function getCompleteDataSet()
    {
        $data = [];
        foreach ($this->dataSet as $row) {
            $data[] = array_combine($this->columns, $row);
        }
        return $data;
    }
}
