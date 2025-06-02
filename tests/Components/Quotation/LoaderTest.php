<?php

namespace Tests\Components\Quotation;

use DOMNode;
use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Quotation\Loader;
use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;
use PierInfor\Agrimer\Components\Quotation\Item;

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
        $params =  (new ParserParams())
            ->setProto('https://')
            ->setHost('rnm.franceagrimer.fr')
            ->setUri('/prix?' . MarketPlaces::M0201_ID . ':MARCHE')
            ->setMarketId(MarketPlaces::M0201_ID)
            ->setQuery('//table[@id=\'tabcotmar\']/tbody/tr/td');
        $this->instance = new Loader($params);
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

    /**
     * testGetUrl
     * @covers PierInfor\Agrimer\Components\Quotation\Loader::getUrl
     */
    public function testGetUrl(): void
    {
        $url = self::getMethod('getUrl')->invokeArgs($this->instance, []);
        $this->assertNotEmpty($url);
    }
}
