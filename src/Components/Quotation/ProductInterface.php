<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\CommonInterface;

/**
 * Product interface
 */
interface ProductInterface extends CommonInterface
{
    const _LF = "\n";
    const _CR = "\r";
    const _M_SPACES = '/\s+/';
    const _S_SPACE = ' ';
    const _CHARSET = 'UTF-8';
    const _ENTITY_DECODER = ENT_QUOTES | ENT_HTML5;

    const _IX_LABEL = 0;
    const _IX_VALUE = 1;
    const _IX_VARIA = 2;
    const _IX_MIN = 3;
    const _IX_MAX = 4;
    const _MAX_IX = 4;

    /**
     * set market id
     * @param string $mid maeket id
     * @return ProductInterface
     */
    public function setMarketId(string $mid): ProductInterface;

    /**
     * get market id
     * @return string
     */
    public function getMarketId(): string;

    /**
     * set item id
     * @param string $id item id
     * @return ProductInterface
     */
    public function setId(string $id): ProductInterface;

    /**
     * get item id
     * @return string
     */
    public function getId(): string;

    /**
     * set item label
     * @param string $label
     * @return ProductInterface
     */
    public function setLabel(string $label): ProductInterface;

    /**
     * get item label
     * @return string
     */
    public function getLabel(): string;

    /**
     * set item value
     * @param string $value
     * @return CommonInterface
     */
    public function setValue(string $value): CommonInterface;

    /**
     * get item value
     * @return float
     */
    public function getValue(): float;

    /**
     * set item min value
     * @param string $min
     * @return CommonInterface
     */
    public function setMin(string $min): CommonInterface;

    /**
     * get item min value
     * @return float
     */
    public function getMin(): float;

    /**
     * set item max value
     * @param string $max
     * @return CommonInterface
     */
    public function setMax(string $max): CommonInterface;

    /**
     * get item max value
     * @return float
     */
    public function getMax(): float;

    /**
     * set item value variation
     * @param string $varia
     * @return ProductInterface
     */
    public function setVaria(string $varia): ProductInterface;

    /**
     * get item value variation
     * @return float
     */
    public function getVaria(): float;
}
