<?php

namespace Component;

use Codeception\TestCase\Test;
use Etki\HamburgroubleBundle\Component\CurrencyConverter;
use UnitTester;

/**
 * Well, here it all starts.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Component
 * @author  Etki <etki@etki.name>
 */
class CurrencyConverterTest extends Test
{
    /**
     * Tester instance.
     * 
     * @type UnitTester
     * @since 0.1.0
     */
    protected $tester;

    // tests

    /**
     * Stupid test!
     *
     * @return void
     * @since 0.1.0
     */
    public function testSingleResult()
    {
        $converter = new CurrencyConverter;
        $this->assertEquals(20, $converter->convert(40, 0.5));
    }
}
