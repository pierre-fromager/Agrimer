<?php

namespace Tests\Components\Quotation;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Quotation\Parser;
use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;
use PierInfor\Agrimer\Components\Quotation\QuotationParser;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\QuotationParser::<public>
 */
class QuotationParserTest extends PFT
{
    const TEST_ENABLE = true;

    const MARKET_ID = 'M0201';

    /**
     * instance
     * @var QuotationParser|null
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
        $this->instance = new QuotationParser($this->getTestParams());
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
        $class = new \ReflectionClass(QuotationParser::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof QuotationParser);
    }

    /**
     * testLoad
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::load
     */
    public function testLoad(): void
    {
        $this->assertTrue($this->instance->load() instanceof QuotationParser);
    }

    /**
     * testParse
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::load
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::parse
     */
    public function testParse(): void
    {
        $this->assertTrue($this->instance->parse() instanceof QuotationParser);
    }

    /**
     * testList
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::parse
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::list
     */
    public function testList(): void
    {
        $this->assertTrue(is_array($this->instance->list()));
        $this->assertEquals(count($this->instance->list()), 0);
        $this->assertTrue($this->instance->parse() instanceof QuotationParser);
        $this->assertNotEquals(count($this->instance->list()), 0);
    }

    /**
     * testInit
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::initParser
     */
    public function testInit(): void
    {
        $this->assertEquals(
            self::getMethod('initParser')->invokeArgs($this->instance, []),
            $this->instance
        );
    }

    /**
     * test process product
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::processProduct
     */
    public function testProcessProduct(): void
    {
        $dom = new \DOMDocument();
        $xml = '<table id="tabcotmar"><tbody>'
            . '<tr>'
            . '<td><a href="#" onclick="histo_lib(57224273,\'\')">LABEL1</a></td>'
            . '<td>VALUE1</td>'
            . '<td>VARIA1</td>'
            . '<td>MIN1</td>'
            . '<td>MAX1</td>'
            . '</tr>'
            . '<tr>'
            . '<td><a href="#" onclick="histo_lib(57224274,\'\')">LABEL2</a></td>'
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
                self::getMethod('processProduct')->invokeArgs($this->instance, [$node]),
                $this->instance
            );
        }
    }

    /**
     * testGetUrl
     * @covers PierInfor\Agrimer\Components\Quotation\QuotationParser::getUrl
     */
    public function testGetUrl(): void
    {
        $url = self::getMethod('getUrl')->invokeArgs($this->instance, []);
        $this->assertNotEmpty($url);
    }
}
