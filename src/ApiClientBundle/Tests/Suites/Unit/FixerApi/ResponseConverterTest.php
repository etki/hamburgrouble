<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\Tests\Unit\FixerApi;

use Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi\Rate;
use Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi\ResponseConverter;
use Codeception\TestCase\Test;
use DateTimeImmutable;
use UnitTester;

/**
 * Tests response converter.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\Tests\Unit\FixerApi
 * @author  Etki <etki@etki.name>
 */
class ResponseConverterTest extends Test
{
    /**
     * Tester instance.
     *
     * @type UnitTester
     * @since 0.1.0
     */
    protected $tester;

    /**
     * Tests that conversion goes as expected.
     *
     * @return void
     * @since 0.1.0
     */
    public function testPlainConversion()
    {
        $baseCurrency = 'USD';
        $targetCurrencyA = 'RUB';
        $conversionRateA = 68.26;
        $targetCurrencyB = 'EUR';
        $conversionRateB = 0.89;
        $date = DateTimeImmutable::createFromFormat(
            'Y-m-d H:i:s',
            '2000-01-01 00:00:00'
        );
        $rateA = new Rate;
        $rateA->setDate($date);
        $rateA->setRate($conversionRateA);
        $rateA->setBaseCurrency($baseCurrency);
        $rateA->setTargetCurrency($targetCurrencyA);
        $rateB = new Rate;
        $rateB->setDate($date);
        $rateB->setRate($conversionRateB);
        $rateB->setBaseCurrency($baseCurrency);
        $rateB->setTargetCurrency($targetCurrencyB);
        $expected = ['RUB' => $rateA, 'EUR' => $rateB,];
        $payload = [
            'base' => $baseCurrency,
            'date' => $date->format('Y-m-d'),
            'rates' => [
                $targetCurrencyA => $conversionRateA,
                $targetCurrencyB => $conversionRateB,
            ],
        ];
        $data = (new ResponseConverter())->convert($payload);
        $this->assertEquals($expected, $data);
    }
}