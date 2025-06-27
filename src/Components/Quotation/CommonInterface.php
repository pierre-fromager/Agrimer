<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

/**
 * Common interface for both product and historic
 */
interface CommonInterface
{
    // const _HIST_IX_DATE = 0;
    // const _HIST_IX_VALUE = 1;
    // const _HIST_IX_MIN = 2;
    // const _HIST_IX_MAX = 3;

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
}
