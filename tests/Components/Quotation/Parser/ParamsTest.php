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
         $this->instance = (new ParserParams())
            ->setProto('https://')
            ->setHost('rnm.franceagrimer.fr')
            ->setUri('/prix?' . MarketPlaces::M0201_ID . ':MARCHE')
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
     * testProto
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setProto
     */
    public function testProto(): void
    {
        $this->assertTrue($this->instance->setProto('https') instanceof ParserParams);
    }

    /**
     * testHost
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setHost
     */
    public function testHost(): void
    {
        $this->assertTrue($this->instance->setHost('host.tld') instanceof ParserParams);
    }

    /**
     * testUri
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::setUri
     */
    public function testUri(): void
    {
        $this->assertTrue($this->instance->setUri('uritest') instanceof ParserParams);
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
     * @covers PierInfor\Agrimer\Components\Quotation\Parser\Params::getUrl
     */
    public function testGetUrl(): void
    {
        $this->assertTrue(is_string($this->instance->getUrl()));
        $this->assertNotEmpty($this->instance->getUrl());
    }
}
