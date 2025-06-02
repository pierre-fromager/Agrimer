<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\ItemInterface;
use PierInfor\Agrimer\Components\Serializer\JsonSerializer;

/**
 * Agrimer quotation item
 */
class Item implements ItemInterface, \JsonSerializable
{
    use JsonSerializer;

    /** @var string */
    protected $mid;

    /** @var string */
    protected $id;

    /** @var string */
    protected $label;

    /** @var float */
    protected $value;

    /** @var float */
    protected $min;

    /** @var float */
    protected $max;

    /** @var float */
    protected $varia;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * initialize item
     * @return ItemInterface
     */
    protected function init(): ItemInterface
    {
        $this->mid = $this->id = $this->label = '';
        $this->value = $this->min = $this->max = $this->varia = 0.0;
        return $this;
    }

    /**
     * set market id
     * @param string $mid
     * @return Item
     */
    public function setMarketId(string $mid): ItemInterface
    {
        $this->mid = $mid;
        return $this;
    }

    /**
     * returns market id
     * @return string
     */
    public function getMarketId(): string
    {
        return $this->mid;
    }

    /**
     * set item id
     * @param string $id
     * @return Item
     */
    public function setId(string $id): ItemInterface
    {
        $this->id = $id;
        return $this;
    }

    /**
     * get item id
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * sanitize label
     * @param string $label
     * @return string
     */
    protected function sanitizeLabel(string $label): string
    {
        $label = str_replace(ItemInterface::_LF, '', $label);
        $label = str_replace(ItemInterface::_CR, '', $label);
        $label = preg_replace(
            ItemInterface::_M_SPACES,
            ItemInterface::_S_SPACE,
            $label
        );
        $label = html_entity_decode(
            $label,
            ItemInterface::_ENTITY_DECODER,
            ItemInterface::_CHARSET
        );
        $label = (string)ltrim(rtrim($label));
        return $label;
    }

    /**
     * set item label
     * @param string $label
     * @return Item
     */
    public function setLabel(string $label): ItemInterface
    {
        $this->label = $this->sanitizeLabel($label);
        $this->setId(md5($this->label));
        return $this;
    }

    /**
     * get item label
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * set item value
     * @param string $value
     * @return ItemInterface
     */
    public function setValue(string $value): ItemInterface
    {
        $this->value = floatval($value);
        return $this;
    }

    /**
     * get item value
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * set item minimum value
     * @param string $min
     * @return ItemInterface
     */
    public function setMin(string $min): ItemInterface
    {
        $this->min = floatval($min);
        return $this;
    }

    /**
     * get item minimum value
     *
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * set item maximum value
     * @param string $max
     * @return ItemInterface
     */
    public function setMax(string $max): ItemInterface
    {
        $this->max = floatval($max);
        return $this;
    }

    /**
     * get item maximum value
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * set item variation
     * @param string $varia
     * @return ItemInterface
     */
    public function setVaria(string $varia): ItemInterface
    {
        $this->varia = floatval($varia);
        return $this;
    }

    /**
     * get item variation
     * @return float
     */
    public function getVaria(): float
    {
        return $this->varia;
    }
}
