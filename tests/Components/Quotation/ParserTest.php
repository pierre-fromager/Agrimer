<?php

namespace Tests\Components\Quotation;

use DOMNode;
use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Quotation\Parser;
use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;
use PierInfor\Agrimer\Components\Quotation\Item;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\Parser::<public>
 */
class ParserTest extends PFT
{
    const TEST_ENABLE = true;

    const MARKET_ID = 'M0201';

    /**
     * instance
     * @var Parser|null
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
        $this->instance = new Parser($params);
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
        $class = new \ReflectionClass(Parser::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Parser);
    }

    /**
     * testLoad
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::load
     */
    public function testLoad(): void
    {
        $this->assertTrue($this->instance->load() instanceof Parser);
    }

    /**
     * testParse
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::load
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::parse
     */
    public function testParse(): void
    {
        $this->assertTrue($this->instance->parse() instanceof Parser);
    }

    /**
     * testList
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::parse
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::list
     */
    public function testList(): void
    {
        $this->assertTrue(is_array($this->instance->list()));
        $this->assertEquals(count($this->instance->list()), 0);
        $this->assertTrue($this->instance->parse() instanceof Parser);
        $this->assertNotEquals(count($this->instance->list()), 0);
    }

    /**
     * testInit
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::initParser
     */
    public function testInit(): void
    {
        $this->assertEquals(
            self::getMethod('initParser')->invokeArgs($this->instance, []),
            $this->instance
        );
    }

    /**
     * test process item
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::processItem
     */
    public function testProcessItem(): void
    {
        $dom = new \DOMDocument();
        $xml = '<table id="tabcotmar"><tbody>'
            . '<tr>'
            . '<td>LABEL1</td>'
            . '<td>VALUE1</td>'
            . '<td>VARIA1</td>'
            . '<td>MIN1</td>'
            . '<td>MAX1</td>'
            . '</tr>'
            . '<tr>'
            . '<td>LABEL2</td>'
            . '<td>VALUE2</td>'
            . '<td>VARIA2</td>'
            . '<td>MIN2</td>'
            . '<td>MAX2</td>'
            . '</tr>'
            . '</tbody></table>';
        $dom->loadXML($xml);
        $xpath =  new \DOMXPath($dom);
        $nodes = $xpath->query('//table[@id=\'tabcotmar\']/tbody/tr/td');
        foreach ($nodes as $node) {
            $this->assertEquals(
                self::getMethod('processItem')->invokeArgs($this->instance, [$node]),
                $this->instance
            );
        }
    }

    /**
     * testGetUrl
     * @covers PierInfor\Agrimer\Components\Quotation\Parser::getUrl
     */
    public function testGetUrl(): void
    {
        $url = self::getMethod('getUrl')->invokeArgs($this->instance, []);
        $this->assertNotEmpty($url);
    }
}
