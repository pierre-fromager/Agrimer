<?php

namespace Tests\Components\Quotation;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Http\Fetch;
use PierInfor\Agrimer\Components\Quotation\Loader;
use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\Loader::<public>
 */
class LoaderTest extends PFT
{
    const TEST_ENABLE = true;

    const MARKET_ID = 'M0201';

    /**
     * instance
     * @var Loader|null
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
        $this->instance = new Loader($this->getTestParams());
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
     * @param String $name
     * @return \ReflectionMethod
     */
    protected static function getMethod(string $name): \ReflectionMethod
    {
        $class = new \ReflectionClass(Loader::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Loader);
    }

    /**
     * testLoad
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::load
     */
    public function testLoad(): void
    {
        $this->assertTrue($this->instance->load() instanceof Loader);
    }

    /**
     * testLoadError
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::load
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::setParams
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::getParams
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::error
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::errorMsg
     */
    public function testLoadError(): void
    {
        $params = $this->instance->getParams()->setUrl('');
        $this->instance->setParams($params);
        $this->assertTrue($this->instance->load() instanceof Loader);
        $this->assertTrue($this->instance->error());
        $this->assertEquals($this->instance->errorMsg(), Fetch::_ERROR_REQ_MSG);
    }

    /**
     * testGetDom
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::load
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::getDom
     */
    public function testGetDom(): void
    {
        $this->assertTrue($this->instance->load() instanceof Loader);
        $this->assertTrue($this->instance->getDom() instanceof \DOMDocument);
    }

    /**
     * testInit
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::initLoader
     */
    public function testInit(): void
    {
        $this->assertEquals(
            self::getMethod('initLoader')->invokeArgs($this->instance, []),
            $this->instance
        );
    }
}
