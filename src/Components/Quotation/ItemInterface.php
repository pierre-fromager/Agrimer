<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

/**
 * Item interface
 */
interface ItemInterface
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

    /**
     * set market id
     * @param string $mid maeket id
     * @return ItemInterface
     */
    public function setMarketId(string $mid): ItemInterface;

    /**
     * get market id
     * @return string
     */
    public function getMarketId(): string;

    /**
     * set item id
     * @param string $id item id
     * @return ItemInterface
     */
    public function setId(string $id): ItemInterface;

    /**
     * get item id
     * @return string
     */
    public function getId(): string;

    /**
     * set item label
     * @param string $label
     * @return ItemInterface
     */
    public function setLabel(string $label): ItemInterface;

    /**
     * get item label
     * @return string
     */
    public function getLabel(): string;

    /**
     * set item value
     * @param string $value
     * @return ItemInterface
     */
    public function setValue(string $value): ItemInterface;

    /**
     * get item value
     * @return float
     */
    public function getValue(): float;

    /**
     * set item min value
     * @param string $min
     * @return ItemInterface
     */
    public function setMin(string $min): ItemInterface;

    /**
     * get item min value
     * @return float
     */
    public function getMin(): float;

    /**
     * set item max value
     * @param string $max
     * @return ItemInterface
     */
    public function setMax(string $max): ItemInterface;

    /**
     * get item max value
     * @return float
     */
    public function getMax(): float;

    /**
     * set item value variation
     * @param string $varia
     * @return ItemInterface
     */
    public function setVaria(string $varia): ItemInterface;

    /**
     * get item value variation
     * @return float
     */
    public function getVaria(): float;
}
