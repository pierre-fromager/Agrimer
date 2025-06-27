<?php

namespace Tests\Components\Market;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Market\Constants;
use PierInfor\Agrimer\Components\Market\Places;

/**
 * @covers \PierInfor\Agrimer\Components\Market\Places::<public>
 */
class PlacesTest extends PFT
{
    const TEST_ENABLE = true;
    const EXPECTED_MARKET_COUNT = 14;

    /**
     * instance
     *
     * @var Places|null
     */
    protected $instance;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        if (!self::TEST_ENABLE) {
            $this->markTestSkipped('Test disabled.');
        }
        $this->instance = new Places();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        $this->instance = null;
    }

    /**
     * get any method from a class to be invoked whatever the scope
     *
     * @param String $name
     * @return \ReflectionMethod
     */
    protected static function getMethod(string $name): \ReflectionMethod
    {
        $class = new \ReflectionClass(Places::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Market\Places::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Places);
    }

    /**
     * testList
     * @covers PierInfor\Agrimer\Components\Market\Places::list
     */
    public function testList(): void
    {
        $this->assertTrue(is_array($this->instance->list()));
        $this->assertEquals(count($this->instance->list()), self::EXPECTED_MARKET_COUNT);
    }

    /**
     * testListIds
     * @covers PierInfor\Agrimer\Components\Market\Places::listIds
     */
    public function testListIds(): void
    {
        $this->assertTrue(is_array($this->instance->listIds()));
        $this->assertEquals(count($this->instance->listIds()), self::EXPECTED_MARKET_COUNT);
    }

    /**
     * testAdd
     * @covers PierInfor\Agrimer\Components\Market\Places::add
     * @covers PierInfor\Agrimer\Components\Market\Places::list
     */
    public function testAdd(): void
    {
        $this->assertEquals(count($this->instance->list()), self::EXPECTED_MARKET_COUNT);
        $this->assertEquals(
            self::getMethod('add')->invokeArgs($this->instance, [Constants::M0201_ID,Constants::M0201_LABEL]),
            $this->instance
        );
        $this->assertEquals(count($this->instance->list()), self::EXPECTED_MARKET_COUNT + 1);
    }

    /**
     * testInit
     * @covers PierInfor\Agrimer\Components\Market\Places::init
     */
    public function testInit(): void
    {
        $this->assertEquals(
            self::getMethod('init')->invokeArgs($this->instance, []),
            $this->instance
        );
    }
}
