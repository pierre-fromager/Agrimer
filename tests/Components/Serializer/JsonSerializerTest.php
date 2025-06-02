<?php

namespace Tests\Components\Serializer;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Serializer\JsonSerializer;

class DummyTest implements \JsonSerializable
{
    use JsonSerializer;

    /** @var string */
    private $priv;
    /** @var string */
    protected $prot;
    /** @var string */
    public $pub;

    public function __construct()
    {
        $this->priv = 'priv';
        $this->prot = 'prot';
        $this->pub = 'pub';
    }
}

/**
 * @covers \PierInfor\Agrimer\Components\Serializer\JsonSerializer::<public>
 */
class JsonSerializeTestTest extends PFT
{
    const TEST_ENABLE = true;

    /** @var DummyTest|null*/
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
        $this->instance = (new DummyTest());
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
        $class = new \ReflectionClass(DummyTest::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers Tests\Components\Serializer\DummyTest::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof DummyTest);
    }


    /**
     * testJsonSerialize
     * @covers PierInfor\Agrimer\Components\Serializer\JsonSerializer::jsonSerialize
     */
    public function testJsonSerialize(): void
    {
        $json = json_encode($this->instance);
        $obj = json_decode($json);
        $this->assertTrue(property_exists($obj, 'priv'));
        $this->assertEquals($obj->priv, 'priv');
        $this->assertTrue(property_exists($obj, 'prot'));
        $this->assertEquals($obj->prot, 'prot');
        $this->assertTrue(property_exists($obj, 'pub'));
        $this->assertEquals($obj->pub, 'pub');
    }
}
