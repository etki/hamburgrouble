<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi;

use DateTimeInterface;

/**
 * Expected response object. Not even close to complete one, but who cares.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\QuandlApi
 * @author  Etki <etki@etki.name>
 */
class Response
{
    /**
     * Data set columns.
     *
     * @type string[]
     * @since 0.1.0
     */
    private $columnNames;
    /**
     * The actual data.
     *
     * @type array
     * @since 0.1.0
     */
    private $dataSet;

    /**
     * Last refresh.
     *
     * @type DateTimeInterface
     * @since 0.1.0
     */
    private $refreshedAt;

    /**
     * Returns columnNames.
     *
     * @return \string[]
     * @since 0.1.0
     */
    public function getColumnNames()
    {
        return $this->columnNames;
    }

    /**
     * Sets columnNames.
     *
     * @param \string[] $columnNames ColumnNames.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setColumnNames($columnNames)
    {
        $this->columnNames = $columnNames;
        return $this;
    }

    /**
     * Returns dataSet.
     *
     * @return array
     * @since 0.1.0
     */
    public function getDataSet()
    {
        return $this->dataSet;
    }

    /**
     * Sets dataSet.
     *
     * @param array $dataSet DataSet.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setDataSet($dataSet)
    {
        $this->dataSet = $dataSet;
        return $this;
    }

    /**
     * Returns refreshedAt.
     *
     * @return DateTimeInterface
     * @since 0.1.0
     */
    public function getRefreshedAt()
    {
        return $this->refreshedAt;
    }

    /**
     * Sets refreshedAt.
     *
     * @param DateTimeInterface $refreshedAt RefreshedAt.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setRefreshedAt($refreshedAt)
    {
        $this->refreshedAt = $refreshedAt;
        return $this;
    }
}
