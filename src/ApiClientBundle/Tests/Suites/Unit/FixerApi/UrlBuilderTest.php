<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\Tests\Unit\FixerApi;

use Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi\UrlBuilder;
use Codeception\TestCase\Test;
use DateTimeImmutable;
use DateTimeInterface;
use UnitTester;

/**
 * URL builder test.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\Tests\Unit\FixerApi
 * @author  Etki <etki@etki.name>
 */
class UrlBuilderTest extends Test
{
    /**
     * Tester instance.
     *
     * @type UnitTester
     * @since 0.1.0
     */
    protected $tester;

    /**
     * Simple data provider.
     *
     * @return array
     * @since 0.1.0
     */
    public function dataProvider()
    {
        return [
            ['api.fixer.io', null, null, null, 'http://api.fixer.io/latest',],
            [
                'api.fixer.io',
                DateTimeImmutable::createFromFormat('Y-m-d', '2000-01-01'),
                'USD',
                ['EUR', 'RUB',],
                'http://api.fixer.io/2000-01-01?base=USD&symbols=EUR%2CRUB'
            ],
        ];
    }

    /**
     * Tests url building
     *
     * @dataProvider dataProvider
     *
     * @param string                   $host             Host to use.
     * @param string|DateTimeInterface $date             Date to create url for.
     * @param string                   $baseCurrency     Base currency.
     * @param string[]                 $targetCurrencies Target currencies.
     * @param string                   $expectedResult   Expected result.
     *
     * @return void
     * @since 0.1.0
     */
    public function testUrlBuilding(
        $host,
        $date,
        $baseCurrency,
        $targetCurrencies,
        $expectedResult
    ) {
        $urlBuilder = new UrlBuilder($host);
        $url = $urlBuilder->getRateConversionUrl(
            $date,
            $baseCurrency,
            $targetCurrencies
        );
        $this->assertEquals($expectedResult, $url);
    }
}