<?php

use Codeception\TestCase\Test;
use Codeception\Util\Debug;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Never throw tests on your real filesystem, kids. Use VFS for that.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package
 * @author  Etki <etki@etki.name>
 */
class RidiculousFilesystemTest extends Test
{
    /**
     * Tester instance.
     *
     * @type UnitTester
     * @since 0.1.0
     */
    protected $tester;

    /**
     * Executes before every test.
     *
     * @return void
     * @since 0.1.0
     */
    protected function _before()
    {
        Debug::debug(__METHOD__);
        (new Filesystem())->remove(static::getTestDirectoryContents());
    }

    /**
     * Executes after every test.
     *
     * @return void
     * @since 0.1.0
     */
    protected function _after()
    {
        Debug::debug(__METHOD__);
        (new Filesystem())->remove(static::getTestDirectoryContents());
    }

    /**
     * Executes once before class is instantiated.
     *
     * @return void
     * @since 0.1.0
     */
    public static function setUpBeforeClass()
    {
        Debug::debug(__METHOD__);
        (new Filesystem())->mkdir(static::getTestDirectory());
    }

    /**
     * Executes after all tests from class were being executed.
     *
     * @return void
     * @since 0.1.0
     */
    public static function tearDownAfterClass()
    {
        Debug::debug(__METHOD__);
        (new Filesystem())->remove(static::getTestDirectory());
    }

    /**
     * Returns test directory address.
     *
     * @return string
     * @since 0.1.0
     */
    private static function getTestDirectory()
    {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'hamburgrouble';
    }

    /**
     * Returns contents of test directory.
     *
     * @return string[]
     * @since 0.1.0
     */
    private static function getTestDirectoryContents()
    {
        return glob(static::getTestDirectory() . DIRECTORY_SEPARATOR . '*');
    }

    // tests
    
    /**
     * I'll force you create that file.
     *
     * @return void
     * @since 0.1.0
     */
    public function testTemporaryFileCreation()
    {
        $fileName = tempnam($this->getTestDirectory(), 'prefix-');
        $this->assertTrue(file_exists($fileName));
    }

    /**
     * Look at me, i'm testing native function, whoa.
     *
     * @return void
     * @since 0.1.0
     */
    public function testScandirOutput()
    {
        $fileName = 'file';
        touch($this->getTestDirectory() . DIRECTORY_SEPARATOR . $fileName);
        $contents = scandir($this->getTestDirectory());
        $this->assertSame(3, count($contents));
        $this->assertContains('.', $contents);
        $this->assertContains('..', $contents);
        $this->assertContains($fileName, $contents);
    }
}
