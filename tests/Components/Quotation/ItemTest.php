<?php

namespace Tests\Components\Quotation;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Quotation\Item;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\Item::<public>
 */
class ItemTest extends PFT
{
    const TEST_ENABLE = true;

    /** @var Item|null*/
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
        $this->instance = new Item();
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
        $class = new \ReflectionClass(Item::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\Item::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Item);
    }

    /**
     * testInit
     * @covers PierInfor\Agrimer\Components\Quotation\Item::init
     */
    public function testInit(): void
    {
        $this->assertEquals(
            self::getMethod('init')->invokeArgs($this->instance, []),
            $this->instance
        );
    }

    /**
     * testSanitizeLabel
     * @covers PierInfor\Agrimer\Components\Quotation\Item::sanitizeLabel
     */
    public function testSanitizeLabel(): void
    {
        $input = " CHOU Rave France\n biologique\r (la pièce) ";
        $expected = 'CHOU Rave France biologique (la pièce)';
        $this->assertEquals(
            self::getMethod('sanitizeLabel')->invokeArgs($this->instance, [$input]),
            $expected
        );
    }

    /**
     * testMarketId
     * @covers PierInfor\Agrimer\Components\Quotation\Item::getMarketId
     * @covers PierInfor\Agrimer\Components\Quotation\Item::setMarketId
     */
    public function testMarketId(): void
    {
        $this->assertTrue($this->instance->setMarketId('') instanceof Item);
        $this->assertTrue(is_string($this->instance->getMarketId()));
        $this->assertEmpty($this->instance->getMarketId());
    }

    /**
     * testId
     * @covers PierInfor\Agrimer\Components\Quotation\Item::getId
     * @covers PierInfor\Agrimer\Components\Quotation\Item::setId
     */
    public function testId(): void
    {
        $this->assertTrue($this->instance->setId('') instanceof Item);
        $this->assertTrue(is_string($this->instance->getId()));
        $this->assertEmpty($this->instance->getId());
    }

    /**
     * testLabel
     * @covers PierInfor\Agrimer\Components\Quotation\Item::getLabel
     * @covers PierInfor\Agrimer\Components\Quotation\Item::setLabel
     */
    public function testLabel(): void
    {
        $this->assertTrue($this->instance->setLabel('') instanceof Item);
        $this->assertTrue(is_string($this->instance->getLabel()));
        $this->assertEmpty($this->instance->getLabel());
    }

    /**
     * testValue
     * @covers PierInfor\Agrimer\Components\Quotation\Item::getValue
     * @covers PierInfor\Agrimer\Components\Quotation\Item::setValue
     */
    public function testValue(): void
    {
        $this->assertTrue($this->instance->setValue(0) instanceof Item);
        $this->assertTrue(is_float($this->instance->getValue()));
        $this->assertEquals($this->instance->getValue(), 0.0);
    }

    /**
     * testMin
     * @covers PierInfor\Agrimer\Components\Quotation\Item::getMin
     * @covers PierInfor\Agrimer\Components\Quotation\Item::setMin
     */
    public function testMin(): void
    {
        $this->assertTrue($this->instance->setMin(0) instanceof Item);
        $this->assertTrue(is_float($this->instance->getMin()));
        $this->assertEquals($this->instance->getMin(), 0.0);
    }

    /**
     * testMax
     * @covers PierInfor\Agrimer\Components\Quotation\Item::getMax
     * @covers PierInfor\Agrimer\Components\Quotation\Item::setMax
     */
    public function testMax(): void
    {
        $this->assertTrue($this->instance->setMax(0) instanceof Item);
        $this->assertTrue(is_float($this->instance->getMax()));
        $this->assertEquals($this->instance->getMax(), 0.0);
    }

    /**
     * testVaria
     * @covers PierInfor\Agrimer\Components\Quotation\Item::getVaria
     * @covers PierInfor\Agrimer\Components\Quotation\Item::setVaria
     */
    public function testVaria(): void
    {
        $this->assertTrue($this->instance->setVaria(0) instanceof Item);
        $this->assertTrue(is_float($this->instance->getVaria()));
        $this->assertEquals($this->instance->getVaria(), 0.0);
    }
}
