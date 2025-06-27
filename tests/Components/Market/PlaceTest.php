<?php

namespace Tests\Components\Market;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Compound\Type;
use PierInfor\Agrimer\Components\Compound\TypeInterface;
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
        $this->instance = (new Place())
            ->setId(Constants::M0201_ID)
            ->setLabel(Constants::M0201_LABEL);
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
     * @covers PierInfor\Agrimer\Components\Market\Place::getTypes
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Place);
        $this->assertTrue($this->instance->getTypes() instanceof Type);
    }

    /**
     * testId
     * @covers PierInfor\Agrimer\Components\Market\Place::setId()
     * @covers PierInfor\Agrimer\Components\Market\Place::getId()
     */
    public function testGetId(): void
    {
        $this->assertTrue($this->instance->setId('test') instanceof Place);
        $this->assertEquals($this->instance->getId(), 'test');
    }

    /**
     * testLabel
     * @covers PierInfor\Agrimer\Components\Market\Place::setLabel()
     * @covers PierInfor\Agrimer\Components\Market\Place::getLabel()
     */
    public function testLabel(): void
    {
        $this->assertTrue($this->instance->setLabel('test') instanceof Place);
        $this->assertEquals($this->instance->getLabel(), 'test');
    }

    /**
     * testSetTypesFromLabel
     * @covers PierInfor\Agrimer\Components\Market\Place::setLabel()
     * @covers PierInfor\Agrimer\Components\Market\Place::getTypes()
     * @covers PierInfor\Agrimer\Components\Market\Place::setTypesFromLabel()
     */
    public function testSetTypesFromLabel(): void
    {
        $invoker = self::getMethod('setTypesFromLabel')->invokeArgs($this->instance, []);
        $this->assertTrue($invoker instanceof Place);
        $bioFruitVegetableMask = TypeInterface::_TYPE_BIO
            | TypeInterface::_TYPE_FRUIT
            | TypeInterface::_TYPE_VEGETABLE;
        $this->assertTrue($this->instance->getTypes()->match($bioFruitVegetableMask));
    }
}
