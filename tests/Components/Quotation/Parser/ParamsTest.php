<?php

namespace Tests\Components\Quotation\Parser;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\Parser\Params::<public>
 */
class ParamsTest extends PFT
{
    const TEST_ENABLE = true;

    /**
     * instance
     *
     * @var ParserParams|null
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
         $this->instance = $this->getTestParams();
    }

    /**
     * get test params
     * @return ParserParams
     */
    protected function getTestParams(): ParserParams
    {
        $url = 'https://rnm.franceagrimer.fr/prix?' . MarketPlaces::M0201_ID . ':MARCHE';
        return (new ParserParams())
            ->setUrl($url)
            ->setMarketId(MarketPlaces::M0201_ID)
            ->setQuery('//table[@id=\'tabcotmar\']/tbody/tr/td');
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
        $class = new \ReflectionClass(ParserParams::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof ParserParams);
    }

    /**
     * test market id
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setMarketId
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::getMarketId
     */
    public function testMarketId(): void
    {
        $this->assertTrue($this->instance->setMarketId(MarketPlaces::M0201_ID) instanceof ParserParams);
        $this->assertNotEmpty($this->instance->getMarketId());
        $this->assertEquals($this->instance->getMarketId(), MarketPlaces::M0201_ID);
    }

    /**
     * test query
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::getQuery
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setQuery
     */
    public function testQuery(): void
    {
        $this->assertTrue($this->instance->setQuery('querytest') instanceof ParserParams);
        $this->assertTrue(is_string($this->instance->getQuery()));
        $this->assertNotEmpty($this->instance->getQuery());
    }

    /**
     * test url
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setUrl
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::getUrl
     */
    public function testUrl(): void
    {
        $this->assertTrue(is_string($this->instance->getUrl()));
        $this->assertNotEmpty($this->instance->getUrl());
        $this->assertTrue($this->instance->setUrl('') instanceof ParserParams);
        $this->assertEmpty($this->instance->getUrl());
    }

    /**
     * test method
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::getMethod
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setMethod
     */
    public function testMethod(): void
    {
        $this->assertTrue(is_string($this->instance->getMethod()));
        $this->assertNotEmpty($this->instance->getMethod());
        $this->assertEquals($this->instance->getMethod(), 'GET');
    }


    /**
     * test vars
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::getVars
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setVars
     */
    public function testVars(): void
    {
        $expected = ['test' => 'test'];
        $this->assertTrue(is_array($this->instance->getVars()));
        $this->assertEmpty($this->instance->getVars());
        $this->assertTrue($this->instance->setVars($expected) instanceof ParserParams);
        $this->assertEquals($this->instance->getVars(), $expected);
    }
}
