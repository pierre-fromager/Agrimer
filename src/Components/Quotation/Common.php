<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\CommonInterface;
use PierInfor\Agrimer\Components\Serializer\JsonSerializer;

/**
 * Agrimer common quotation for both product and historic
 */
class Common implements CommonInterface, \JsonSerializable
{
    use JsonSerializer;

    /** @var float */
    protected $value;

    /** @var float */
    protected $min;

    /** @var float */
    protected $max;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * initialize product
     * @return CommonInterface
     */
    protected function init(): CommonInterface
    {
        $this->value = $this->min = $this->max = 0.0;
        return $this;
    }


    /**
     * set product value
     * @param string $value
     * @return CommonInterface
     */
    public function setValue(string $value): CommonInterface
    {
        $this->value = floatval($value);
        return $this;
    }

    /**
     * get product value
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * set product minimum value
     * @param string $min
     * @return CommonInterface
     */
    public function setMin(string $min): CommonInterface
    {
        $this->min = floatval($min);
        return $this;
    }

    /**
     * get product minimum value
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * set product maximum value
     * @param string $max
     * @return CommonInterface
     */
    public function setMax(string $max): CommonInterface
    {
        $this->max = floatval($max);
        return $this;
    }

    /**
     * get product maximum value
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }
}
