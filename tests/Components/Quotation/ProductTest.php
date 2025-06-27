<?php

namespace Tests\Components\Quotation;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Compound\Type;
use PierInfor\Agrimer\Components\Compound\TypeInterface;
use PierInfor\Agrimer\Components\Quotation\Product;
use PierInfor\Agrimer\Components\Quotation\ProductInterface;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\Product::<public>
 */
class ProductTest extends PFT
{
    const TEST_ENABLE = true;

    /** @var Product|null*/
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
        $this->instance = new Product();
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
        $class = new \ReflectionClass(Product::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\Product::__construct
     * @covers PierInfor\Agrimer\Components\Quotation\Common::__construct
     * @covers PierInfor\Agrimer\Components\Quotation\Product::initProduct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof ProductInterface);
    }

    /**
     * testInit
     * @covers PierInfor\Agrimer\Components\Quotation\Product::init
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
     * @covers PierInfor\Agrimer\Components\Quotation\Product::sanitizeLabel
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
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getMarketId
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setMarketId
     */
    public function testMarketId(): void
    {
        $this->assertTrue($this->instance->setMarketId('') instanceof ProductInterface);
        $this->assertTrue(is_string($this->instance->getMarketId()));
        $this->assertEmpty($this->instance->getMarketId());
    }

    /**
     * testId
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getId
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setId
     */
    public function testId(): void
    {
        $this->assertTrue($this->instance->setId('') instanceof ProductInterface);
        $this->assertTrue(is_string($this->instance->getId()));
        $this->assertEmpty($this->instance->getId());
    }

    /**
     * testLabel
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getLabel
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setLabel
     */
    public function testLabel(): void
    {
        $this->assertTrue($this->instance->setLabel('') instanceof ProductInterface);
        $this->assertTrue(is_string($this->instance->getLabel()));
        $this->assertEmpty($this->instance->getLabel());
    }

    /**
     * testValue
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getValue
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setValue
     */
    public function testValue(): void
    {
        $this->assertTrue($this->instance->setValue(0) instanceof ProductInterface);
        $this->assertTrue(is_float($this->instance->getValue()));
        $this->assertEquals($this->instance->getValue(), 0.0);
    }

    /**
     * testMin
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getMin
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setMin
     */
    public function testMin(): void
    {
        $this->assertTrue($this->instance->setMin(0) instanceof ProductInterface);
        $this->assertTrue(is_float($this->instance->getMin()));
        $this->assertEquals($this->instance->getMin(), 0.0);
    }

    /**
     * testMax
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getMax
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setMax
     */
    public function testMax(): void
    {
        $this->assertTrue($this->instance->setMax(0) instanceof ProductInterface);
        $this->assertTrue(is_float($this->instance->getMax()));
        $this->assertEquals($this->instance->getMax(), 0.0);
    }

    /**
     * testVaria
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getVaria
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setVaria
     */
    public function testVaria(): void
    {
        $this->assertTrue($this->instance->setVaria(0) instanceof ProductInterface);
        $this->assertTrue(is_float($this->instance->getVaria()));
        $this->assertEquals($this->instance->getVaria(), 0.0);
    }

    /**
     * testType
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getType
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setType
     */
    public function testType(): void
    {
        $initialType = $this->instance->getType();
        $this->assertTrue($initialType instanceof Type);
        $this->assertTrue($this->instance->setType($initialType) instanceof ProductInterface);
        $productTypes = [
            TypeInterface::_TYPE_BIO,
            TypeInterface::_TYPE_FRUIT,
            TypeInterface::_TYPE_VEGETABLE
        ];
        foreach ($productTypes as $type) {
            $this->instance->getType()->flag($type);
        }
        $bioFruitVegeMatch = TypeInterface::_TYPE_BIO
            | TypeInterface::_TYPE_FRUIT
            | TypeInterface::_TYPE_VEGETABLE;
        $this->assertTrue($this->instance->getType()->match($bioFruitVegeMatch));
    }

    /**
     * testCode
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getCode
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setCode
     */
    public function testCode(): void
    {
        $this->assertTrue($this->instance->setCode(0) instanceof ProductInterface);
        $this->assertTrue(is_int($this->instance->getCode()));
        $this->assertEquals($this->instance->getCode(), 0);
    }

    /**
     * testSetLibcode
     * @covers PierInfor\Agrimer\Components\Quotation\Product::setLibcode
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getCode
     */
    public function testSetLibcode()
    {
        $onclickText = "histo_lib(57224273,'')";
        $expected = 57224273;
        $doc = new \DOMDocument();
        $td = $doc->createElement('td');
        $a = $doc->createElement('a');
        $a->setAttribute('onclick', $onclickText);
        $td->appendChild($a);
        $this->assertEquals(
            self::getMethod('setLibcode')->invokeArgs($this->instance, [$td]),
            $this->instance
        );
        $this->assertEquals($this->instance->getCode(), $expected);
    }

    /**
     * testDomHydrate
     * @covers PierInfor\Agrimer\Components\Quotation\Product::domHydrate
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getLabel
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getValue
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getVaria
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getMin
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getMax
     * @covers PierInfor\Agrimer\Components\Quotation\Product::getCode
     */
    public function testDomHydrate()
    {
        $dom = new \DOMDocument();
        $xml = '<table id="tabcotmar"><tbody>'
            . '<tr>'
            . '<td><a href="#" onclick="histo_lib(57224273,\'\')">LABEL1</a></td>'
            . '<td>10.99</td>'
            . '<td>2.3</td>'
            . '<td>5</td>'
            . '<td>12</td>'
            . '</tr>'
            . '</tbody></table>';
        $dom->loadXML($xml);
        $xpath =  new \DOMXPath($dom);
        $tds = $xpath->query('//table[@id=\'tabcotmar\']/tbody/tr/td');
        $cpt = 0;
        foreach ($tds as $td) {
            $this->instance->domHydrate($td, $cpt);
            $cpt++;
        }
        $this->assertEquals($this->instance->getLabel(), 'LABEL1');
        $this->assertEquals($this->instance->getValue(), 10.99);
        $this->assertEquals($this->instance->getVaria(), 2.3);
        $this->assertEquals($this->instance->getMin(), 5);
        $this->assertEquals($this->instance->getMax(), 12);
        $this->assertEquals($this->instance->getCode(), 57224273);
    }
}
