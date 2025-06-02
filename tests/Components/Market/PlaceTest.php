<?php

namespace Tests\Components\Market;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Market\Constants;
use PierInfor\Agrimer\Components\Market\Place;

/**
 * @covers \PierInfor\Agrimer\Components\Market\Place::<public>
 */
class PlaceTest extends PFT
{
    const TEST_ENABLE = true;

    /**
     * instance
     *
     * @var Place|null
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
        $this->instance = new Place(Constants::M0201_ID, Constants::M0201_LABEL);
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
        $class = new \ReflectionClass(Place::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Market\Place::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Place);
    }
}
