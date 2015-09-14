<?php

namespace Etki\Projects\Hamburgrouble\HamburgroubleBundle\Exception\Service;

use Etki\Projects\Hamburgrouble\HamburgroubleBundle\Exception\BadMethodCallException;

/**
 * This exception is designed to be thrown if client has specified invalid
 * period.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\HamburgroubleBundle\Exception\Service
 * @author  Etki <etki@etki.name>
 */
class InvalidDataPeriodException extends BadMethodCallException
{
    /**
     * Invalid data period that caused exception.
     *
     * @type string
     * @since 0.1.0
     */
    private $dataPeriod;

    /**
     * Returns invalid data period.
     *
     * @return string
     * @since 0.1.0
     */
    public function getDataPeriod()
    {
        return $this->dataPeriod;
    }

    /**
     * Sets invalid data period.
     *
     * @param string $dataPeriod DataPeriod.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setDataPeriod($dataPeriod)
    {
        $this->dataPeriod = $dataPeriod;
        return $this;
    }
}
