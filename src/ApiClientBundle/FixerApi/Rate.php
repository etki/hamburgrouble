<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi;

use DateTimeImmutable;

/**
 * Rate definition.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi
 * @author  Etki <etki@etki.name>
 */
class Rate
{
    /**
     * Rate date.
     *
     * @type DateTimeImmutable
     * @since 0.1.0
     */
    private $date;
    /**
     * Base currency.
     *
     * @type string
     * @since 0.1.0
     */
    private $baseCurrency;
    /**
     * Target currency.
     *
     * @type string
     * @since 0.1.0
     */
    private $targetCurrency;
    /**
     * Rate.
     *
     * @type float
     * @since 0.1.0
     */
    private $rate;

    /**
     * Returns date.
     *
     * @return DateTimeImmutable
     * @since 0.1.0
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets date.
     *
     * @param DateTimeImmutable $date Date.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Returns baseCurrency.
     *
     * @return string
     * @since 0.1.0
     */
    public function getBaseCurrency()
    {
        return $this->baseCurrency;
    }

    /**
     * Sets baseCurrency.
     *
     * @param string $baseCurrency BaseCurrency.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setBaseCurrency($baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;
        return $this;
    }

    /**
     * Returns targetCurrency.
     *
     * @return string
     * @since 0.1.0
     */
    public function getTargetCurrency()
    {
        return $this->targetCurrency;
    }

    /**
     * Sets targetCurrency.
     *
     * @param string $targetCurrency TargetCurrency.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setTargetCurrency($targetCurrency)
    {
        $this->targetCurrency = $targetCurrency;
        return $this;
    }

    /**
     * Returns rate.
     *
     * @return float
     * @since 0.1.0
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Sets rate.
     *
     * @param float $rate Rate.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }
}
