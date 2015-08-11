<?php

namespace Etki\HamburgroubleBundle\Component;

/**
 * A simple currency converter. For erm testing, yeah.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\HamburgroubleBundle\Component
 * @author  Etki <etki@etki.name>
 */
class CurrencyConverter
{
    /**
     * Converts specified amount of money in one currency to some amount of
     * money in other currency.
     *
     * @param float $amount Amount of money.
     * @param float $rate   Conversion rate.
     *
     * @return float
     * @since 0.1.0
     */
    public function convert($amount, $rate)
    {
        return $amount * $rate;
    }
}
