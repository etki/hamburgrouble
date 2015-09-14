<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi;

use DateTimeImmutable;

/**
 * Converts Fixer response into rate collection.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi
 * @author  Etki <etki@etki.name>
 */
class ResponseConverter
{
    /**
     * Converts response to rate collection.
     *
     * @param array $data Data to convert.
     *
     * @return Rate[]
     * @since 0.1.0
     */
    public function convert(array $data)
    {
        $rates = [];
        $date = new DateTimeImmutable($data['date']);
        $baseCurrency = $data['base'];
        foreach ($data['rates'] as $targetCurrency => $rate) {
            $dto = new Rate;
            $dto->setBaseCurrency($baseCurrency);
            $dto->setTargetCurrency($targetCurrency);
            $dto->setRate($rate);
            $dto->setDate($date);
            $rates[$targetCurrency] = $dto;
        }
        return $rates;
    }
}
