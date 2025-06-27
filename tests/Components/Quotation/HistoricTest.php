<?php

namespace Tests\Components\Quotation;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Quotation\Historic;
use PierInfor\Agrimer\Components\Quotation\HistoricInterface;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\Historic::<public>
 */
class HistoricTest extends PFT
{
    const TEST_ENABLE = true;

    /** @var Historic|null*/
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
        $this->instance = new Historic();
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
        $class = new \ReflectionClass(Historic::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::__construct
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::initCommon
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof HistoricInterface);
    }

    /**
     * testInit
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::init
     */
    public function testInit(): void
    {
        $this->assertEquals(
            self::getMethod('init')->invokeArgs($this->instance, []),
            $this->instance
        );
    }

    /**
     * testValue
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getValue
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::setValue
     */
    public function testValue(): void
    {
        $this->assertTrue($this->instance->setValue(0) instanceof HistoricInterface);
        $this->assertTrue(is_float($this->instance->getValue()));
        $this->assertEquals($this->instance->getValue(), 0.0);
    }

    /**
     * testMin
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getMin
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::setMin
     */
    public function testMin(): void
    {
        $this->assertTrue($this->instance->setMin(0) instanceof HistoricInterface);
        $this->assertTrue(is_float($this->instance->getMin()));
        $this->assertEquals($this->instance->getMin(), 0.0);
    }

    /**
     * testMax
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getMax
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::setMax
     */
    public function testMax(): void
    {
        $this->assertTrue($this->instance->setMax(0) instanceof HistoricInterface);
        $this->assertTrue(is_float($this->instance->getMax()));
        $this->assertEquals($this->instance->getMax(), 0.0);
    }

    /**
     * testDomHydrateHistoric
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::domHydrateHistoric
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getDate
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getValue
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getMin
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getMax
     * @covers PierInfor\Agrimer\Components\Quotation\Historic::getFormatedDate
     */
    public function testDomHydrate()
    {
        $dom = new \DOMDocument();
        $xml = '<table class="tabcot">'
            . '<tbody>'
            . '<tr>'
            . '<td class="tdcotr">12/06/25 </td>'
            . '<td class="tdcotr">5.06 </td>'
            . '<td class="tdcotr">4.19 </td>'
            . '<td class="tdcotr">6.00 </td>'
            . '</tr>'
            . '</tbody>'
            . '</table>';
        $dom->loadXML($xml);
        $xpath =  new \DOMXPath($dom);
        $tds = $xpath->query('//table[@class=\'tabcot\']/tbody/tr/td');
        $cpt = 0;
        foreach ($tds as $td) {
            $this->instance->domHydrateHistoric($td, $cpt);
            $cpt++;
        }
        $this->assertEquals($this->instance->getDate(), '2025-06-12');
        $this->assertEquals($this->instance->getValue(), 5.06);
        $this->assertEquals($this->instance->getMin(), 4.19);
        $this->assertEquals($this->instance->getMax(), 6.00);
    }
}
