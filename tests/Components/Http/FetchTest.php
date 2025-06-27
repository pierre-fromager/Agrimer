<?php

namespace Tests\Components\Http;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Agrimer\Components\Http\Fetch;
use PierInfor\Agrimer\Components\Http\FetchInterface;

/**
 * @covers \PierInfor\Agrimer\Components\Http\Fetch::<public>
 */
class FetchTest extends PFT
{
    const TEST_ENABLE = true;
    const _URL_GOOGLE = 'https://www.google.com';

    /** @var Fetch|null*/
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
        $this->instance = new Fetch();
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
        $class = new \ReflectionClass(Fetch::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Agrimer\Components\Http\Fetch::__construct
     * @covers PierInfor\Agrimer\Components\Http\Fetch::init
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Fetch);
        $this->assertTrue(
            self::getMethod('init')->invokeArgs($this->instance, []) instanceof Fetch
        );
    }

    /**
     * testMethod
     * @covers PierInfor\Agrimer\Components\Http\Fetch::setMethod
     */
    public function testMethod(): void
    {
        $invoker = $this->instance->setMethod(FetchInterface::_GET_METHOD);
        $this->assertTrue($invoker instanceof Fetch);
        $invoker = $this->instance->setMethod(FetchInterface::_POST_METHOD);
        $this->assertTrue($invoker instanceof Fetch);
    }

    /**
     * testUrl
     * @covers PierInfor\Agrimer\Components\Http\Fetch::setUrl
     */
    public function testUrl(): void
    {
        $invoker = $this->instance->setUrl(self::_URL_GOOGLE);
        $this->assertTrue($invoker instanceof Fetch);
    }

    /**
     * testVars
     * @covers PierInfor\Agrimer\Components\Http\Fetch::setVars
     */
    public function testVars(): void
    {
        $this->assertTrue($this->instance->setVars([]) instanceof Fetch);
    }

    /**
     * testContent
     * @covers PierInfor\Agrimer\Components\Http\Fetch::getContent
     */
    public function testContent(): void
    {
        $this->assertTrue(is_string(($this->instance->getContent([]))));
        $this->assertTrue(empty(($this->instance->getContent([]))));
    }

    /**
     * testOptions
     * @covers PierInfor\Agrimer\Components\Http\Fetch::getOptions
     * @covers PierInfor\Agrimer\Components\Http\Fetch::setMethod
     */
    public function testOptions(): void
    {
        $this->assertTrue(
            is_array(self::getMethod('getOptions')->invokeArgs($this->instance, []))
        );
        $this->instance->setMethod(FetchInterface::_POST_METHOD);
        $this->assertTrue(
            is_array(self::getMethod('getOptions')->invokeArgs($this->instance, []))
        );
    }

    /**
     * testContext
     * @covers PierInfor\Agrimer\Components\Http\Fetch::getContext
     */
    public function testContext(): void
    {
        $this->instance->setUrl(self::_URL_GOOGLE)->setMethod(Fetch::_GET_METHOD);
        $invoke = self::getMethod('getContext')->invokeArgs($this->instance, []);
        $this->assertTrue(is_resource($invoke));

        $this->expectException(\Exception::class);
        $this->instance->setUrl('')->setMethod(Fetch::_GET_METHOD);
        $invoke = self::getMethod('getContext')->invokeArgs($this->instance, []);
        $this->assertTrue(is_resource($invoke));
    }

    /**
     * testExecute
     * @covers PierInfor\Agrimer\Components\Http\Fetch::execute
     */
    public function testExecute(): void
    {
        $this->instance->setUrl(self::_URL_GOOGLE)->setMethod(Fetch::_GET_METHOD);
        $invoker = $this->instance->execute();
        $this->assertTrue($invoker instanceof Fetch);
    }
}
