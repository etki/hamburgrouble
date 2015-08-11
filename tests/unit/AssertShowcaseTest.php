<?php

use Codeception\TestCase\Test;

/**
 * A simple showcase of PHPUnit's assert possibilities.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package 
 * @author  Etki <etki@etki.name>
 */
class AssertShowcaseTest extends Test
{
    /**
     * Tester instance.
     * 
     * @type UnitTester
     * @since 0.1.0
     */
    protected $tester;

    // tests
    
    
    public function testAssertSame()
    {
        $this->assertSame(2, 2);
        $this->assertSame(2, 2.0);
    }
    
    public function testAssertEquals()
    {
        $this->assertEquals(2.0, 2);
        $this->assertEquals(true, 1);
    }
    
    public function testAssertNotNull()
    {
        $this->assertNotNull(1);
        $this->assertNotNull(null);
    }
    
    public function testStringAsserts()
    {
        $this->assertStringStartsWith('prefix', 'prefixed message');
        $this->assertStringMatchesFormat('%d %d', '2 2');
        $this->assertJsonStringEqualsJsonString(
            '{"a":1,"b":2}',
            '{"b":2,"a":1}'
        );
    }
    
    public function testArrayAsserts()
    {
        $this->assertArraySubset(
                        ['b' => 'd', 'c' => 'e',],
            ['a' => 'a', 'b' => 'd', 'c' => 'e', 'f' => 12,]
        );
        $this->assertArrayHasKey('ham', ['ham' => 12, 'burger' => 13,]);
    }

    public function testAssertInstanceOf()
    {
        $this->assertInstanceOf('stdClass', new stdClass);
        // oh hi there! can you tell what's wrong with the next lines?
        $fileName = tempnam(sys_get_temp_dir(), '');
        $this->assertInstanceOf('SplFileInfo', new SplFileObject($fileName));
    }
}
