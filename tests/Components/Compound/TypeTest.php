<?php

namespace Tests\Components\Compound;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Compound\Type;

/**
 * @covers \PierInfor\Agrimer\Components\Compound\Type::<public>
 */
class TypeTest extends PFT
{
    const TEST_ENABLE = true;

    /** @var Type|null*/
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
        $this->instance = new Type();
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
        $class = new \ReflectionClass(Type::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Compound\Type::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Type);
    }

    /**
     * testFlag
     * @covers PierInfor\Agrimer\Components\Compound\Type::flag
     * @covers PierInfor\Agrimer\Components\Compound\Type::check
     * @covers PierInfor\Agrimer\Components\Compound\Type::unflag
     * @covers PierInfor\Agrimer\Components\Compound\Type::getType
     * @covers PierInfor\Agrimer\Components\Compound\Type::match
     */
    public function testFlag(): void
    {
        $this->assertEquals($this->instance->getType(), 0);
        $this->assertTrue($this->instance->flag(Type::_TYPE_BIO) instanceof Type);
        $this->assertEquals($this->instance->getType(), 1);
        $this->assertTrue($this->instance->check(Type::_TYPE_BIO));
        $this->assertTrue($this->instance->flag(Type::_TYPE_FRUIT) instanceof Type);
        $this->assertTrue($this->instance->check(Type::_TYPE_FRUIT));
        $bioFruitMask = Type::_TYPE_FRUIT | Type::_TYPE_BIO;
        $this->assertTrue($this->instance->match($bioFruitMask));
        $this->assertTrue($this->instance->unflag(Type::_TYPE_BIO) instanceof Type);
        $this->assertFalse($this->instance->match($bioFruitMask));
        $this->assertFalse($this->instance->check(Type::_TYPE_BIO));
        $this->assertEquals($this->instance->getType(), 2);
        $this->assertTrue($this->instance->check(Type::_TYPE_FRUIT));
        $this->assertTrue($this->instance->unflag(Type::_TYPE_FRUIT) instanceof Type);
        $this->assertFalse($this->instance->check(Type::_TYPE_FRUIT));
        $this->assertEquals($this->instance->getType(), 0);
    }

    /**
     * testReset
     * @covers PierInfor\Agrimer\Components\Compound\Type::reset
     */
    public function testReset(): void
    {
        $this->assertEquals(
            self::getMethod('reset')->invokeArgs($this->instance, []),
            $this->instance
        );
    }

    /**
     * testSetFlag
     * @covers PierInfor\Agrimer\Components\Compound\Type::setFlag
     * @covers PierInfor\Agrimer\Components\Compound\Type::getType
     */
    public function testSetFlag(): void
    {
        $this->assertEquals(
            self::getMethod('setFlag')->invokeArgs($this->instance, [1, true]),
            1
        );
        $this->assertEquals($this->instance->getType(), 1);
        $this->assertEquals(
            self::getMethod('setFlag')->invokeArgs($this->instance, [1, false]),
            0
        );
        $this->assertEquals($this->instance->getType(), 0);
    }

    /**
     * testGetMask
     * @covers PierInfor\Agrimer\Components\Compound\Type::getMask
     */
    public function testGetMask(): void
    {
        $this->assertEquals(
            self::getMethod('getMask')->invokeArgs($this->instance, [0]),
            1
        );
        $this->assertEquals(
            self::getMethod('getMask')->invokeArgs($this->instance, [1]),
            2
        );
        $this->assertEquals(
            self::getMethod('getMask')->invokeArgs($this->instance, [2]),
            4
        );
        $maxbit = PHP_INT_SIZE * 8;
        $this->assertEquals(
            self::getMethod('getMask')->invokeArgs($this->instance, [$maxbit]),
            1 << $maxbit
        );
    }
}
