<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Compound\Type;
use PierInfor\Agrimer\Components\Quotation\CommonInterface;
use PierInfor\Agrimer\Components\Quotation\Common;
use PierInfor\Agrimer\Components\Quotation\ProductInterface;
use PierInfor\Agrimer\Components\Serializer\JsonSerializer;

/**
 * Agrimer quotation product
 */
class Product extends Common implements CommonInterface, ProductInterface, \JsonSerializable
{
    use JsonSerializer;

    /** @var string */
    protected $mid;

    /** @var string */
    protected $id;

    /** @var string */
    protected $label;

    /** @var float */
    protected $varia;

    /** @var Type */
    protected $type;

    /** @var integer */
    protected $code;

    /**
     * ctor
     */
    public function __construct()
    {
        parent::__construct();
        $this->initProduct();
    }

    /**
     * initialize product
     * @return ProductInterface
     */
    protected function initProduct(): ProductInterface
    {
        $this->mid = $this->id = $this->label = '';
        $this->varia = 0.0;
        $this->type = new Type();
        $this->code = 0;
        return $this;
    }

    /**
     * set market id
     * @param string $mid
     * @return product
     */
    public function setMarketId(string $mid): ProductInterface
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
     * set product id
     * @param string $id
     * @return product
     */
    public function setId(string $id): ProductInterface
    {
        $this->id = $id;
        return $this;
    }

    /**
     * get product id
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
        $label = str_replace(ProductInterface::_LF, '', $label);
        $label = str_replace(ProductInterface::_CR, '', $label);
        $label = preg_replace(
            ProductInterface::_M_SPACES,
            ProductInterface::_S_SPACE,
            $label
        );
        $label = html_entity_decode(
            $label,
            ProductInterface::_ENTITY_DECODER,
            ProductInterface::_CHARSET
        );
        $label = (string)ltrim(rtrim($label));
        return $label;
    }

    /**
     * set product label
     * @param string $label
     * @return product
     */
    public function setLabel(string $label): ProductInterface
    {
        $this->label = $this->sanitizeLabel($label);
        $this->setId(md5($this->label));
        return $this;
    }

    /**
     * get product label
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
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
     * get product minimum value
     * @return float
     */
    public function getMin(): float
    {
        return $this->min;
    }

    /**
     * get product maximum value
     * @return float
     */
    public function getMax(): float
    {
        return $this->max;
    }

    /**
     * set product variation
     * @param string $varia
     * @return ProductInterface
     */
    public function setVaria(string $varia): ProductInterface
    {
        $this->varia = floatval($varia);
        return $this;
    }

    /**
     * get product variation
     * @return float
     */
    public function getVaria(): float
    {
        return $this->varia;
    }

    /**
     * set product type
     * @param Type $type
     * @return ProductInterface
     */
    public function setType(Type $type): ProductInterface
    {
        $this->type = $type;
        return $this;
    }

    /**
     * get product type
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * set product code
     * @param integer $code
     * @return ProductInterface
     */
    public function setCode(int $code): ProductInterface
    {
        $this->code = $code;
        return $this;
    }

    /**
     * get product code
     * @return integer
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * grab libcod from a onclick attr text content
     * @param \DOMNode $node
     * @return ProductInterface
     */
    protected function setLibcode(\DOMNode $node): ProductInterface
    {
        if (!is_null($node->firstChild)) {
            $onClick = $node->firstChild->attributes->getNamedItem('onclick');
            $code = str_replace('histo_lib(', '', $onClick->textContent);
            $code = str_replace(',\'\')', '', $code);
            $this->setCode(intval($code));
        }
        return $this;
    }

    /**
     * hydrate product field from DOMNode and field index
     * @param \DOMNode $node
     * @param integer $ixpr
     * @return ProductInterface
     */
    public function domHydrate(\DOMNode $node, int $ixpr): ProductInterface
    {
        $ct = $node->textContent;
        switch ($ixpr) {
            case ProductInterface::_IX_LABEL:
                $this->setLibcode($node)->setLabel($ct);
                break;
            case ProductInterface::_IX_VALUE:
                $this->setValue($ct);
                break;
            case ProductInterface::_IX_VARIA:
                $this->setVaria($ct);
                break;
            case ProductInterface::_IX_MIN:
                $this->setMin($ct);
                break;
            case ProductInterface::_IX_MAX:
                $this->setMax($ct);
                break;
        }
        return $this;
    }
}
