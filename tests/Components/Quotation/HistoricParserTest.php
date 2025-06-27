<?php

namespace Tests\Components\Quotation;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;
use PierInfor\Agrimer\Components\Quotation\HistoricParser;
use PierInfor\Agrimer\Components\Http\Fetch;

/**
 * @covers \PierInfor\Agrimer\Components\Quotation\HistoricParser::<public>
 */
class HistoricParserTest extends PFT
{
    const TEST_ENABLE = true;

    const MARKET_ID = 'M0201';

    /**
     * instance
     * @var HistoricParser|null
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
        $this->instance = new HistoricParser($this->getTestParams());
    }

    /**
     * get test params
     * @return ParserParams
     */
    protected function getTestParams(): ParserParams
    {
        $url = 'https://rnm.franceagrimer.fr/prix';
        return (new ParserParams())
            ->setMethod(Fetch::_POST_METHOD)
            ->setUrl($url)
            ->setVars(['LAST' => '', 'LIBCOD' => 57224273])
            ->setQuery('//table[@class=\'tabcot\']/tbody/tr/td');
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
        $class = new \ReflectionClass(HistoricParser::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof HistoricParser);
    }

    /**
     * testLoad
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::load
     */
    public function testLoad(): void
    {
        $this->assertTrue($this->instance->load() instanceof HistoricParser);
    }

    /**
     * testParse
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::load
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::parse
     */
    public function testParse(): void
    {
        $this->assertTrue($this->instance->parse() instanceof HistoricParser);
    }

    /**
     * testList
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::parse
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::list
     */
    public function testList(): void
    {
        $this->assertTrue(is_array($this->instance->list()));
        $this->assertEquals(count($this->instance->list()), 0);
        $this->assertTrue($this->instance->parse() instanceof HistoricParser);
        $this->assertNotEquals(count($this->instance->list()), 0);
    }

    /**
     * testInitHistoricParser
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::initHistoricParser
     */
    public function testInit(): void
    {
        $this->assertEquals(
            self::getMethod('initHistoricParser')->invokeArgs($this->instance, []),
            $this->instance
        );
    }

    /**
     * test product historic
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::processHistoric
     */
    public function testProcessProduct(): void
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
             . '<tr>'
            . '<td class="tdcotr"> 13/06/25</td>'
            . '<td class="tdcotr">5.06 </td>'
            . '<td class="tdcotr">4.19 </td>'
            . '<td class="tdcotr">6.00 </td>'
            . '</tr>'
            . '</tbody>'
            . '</table>';
        $dom->loadXML($xml);
        $xpath =  new \DOMXPath($dom);
        $nodes = $xpath->query('//table[@class=\'tabcot\']/tbody/tr/td');
        foreach ($nodes as $node) {
            $this->assertEquals(
                self::getMethod('processHistoric')->invokeArgs($this->instance, [$node]),
                $this->instance
            );
        }
    }

    /**
     * testGetUrl
     * @covers PierInfor\Agrimer\Components\Quotation\HistoricParser::getUrl
     */
    public function testGetUrl(): void
    {
        $url = self::getMethod('getUrl')->invokeArgs($this->instance, []);
        $this->assertNotEmpty($url);
    }
}
