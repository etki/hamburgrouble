<?php

namespace Etki\Projects\Hamburgrouble\ApiClientBundle\Tests\Functional\FixerApi;

use Codeception\TestCase\Test;
use Etki\Projects\Hamburgrouble\ApiClientBundle\FixerApi\Client;
use FunctionalTester;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Psr\Log\LoggerInterface;

/**
 * Tests Fixer API client in near-real-life conditions.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\Projects\Hamburgrouble\ApiClientBundle\Tests\Functional\FixerApi
 * @author  Etki <etki@etki.name>
 */
class FixerApiClientTest extends Test
{
    /**
     * Tester instance.
     *
     * @type FunctionalTester
     * @since 0.1.0
     */
    protected $tester;

    /**
     * Provides test data.
     *
     * @return array
     * @since 0.1.0
     */
    public function responseDataProvider()
    {
        return [
            ['USD', '2010-09-01', ['EUR' => 0.8946, 'RUB' => 68.256,],],
            ['RUB', '2015-01-01', ['USD' => 70.99, 'EUR' => 80.99,],],
        ];
    }

    /**
     * Tests rate fetching.
     *
     * @param string  $base  Base currency.
     * @param string  $date  Date.
     * @param float[] $rates Rates in [currency => rate] format.
     *
     * @dataProvider responseDataProvider
     *
     * @since 0.1.0
     */
    public function testRateFetching($base, $date, array $rates)
    {
        $response = ['base' => $base, 'date' => $date, 'rates' => $rates,];
        $queue = [new Response(200, [], json_encode($response)),];
        $handler = HandlerStack::create(new MockHandler($queue));
        $guzzle = new Guzzle(['handler' => $handler,]);
        /** @type LoggerInterface $logger */
        $logger = $this->getMock('Psr\Log\LoggerInterface');
        $fixerApiClient = new Client($guzzle, $logger);
        $retrievedRates = $fixerApiClient->getRates(
            $base,
            array_keys($rates),
            $date
        );
        $this->assertSameSize($rates, $retrievedRates);
        foreach ($rates as $currency => $rate) {
            $this->assertEquals($retrievedRates[$currency]->getRate(), $rate);
        }
    }
}