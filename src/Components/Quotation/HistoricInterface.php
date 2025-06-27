<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

/**
 * Historic interface use commonInterface
 */
interface HistoricInterface extends CommonInterface
{
    const _IX_DATE = 0;
    const _IX_VALUE = 1;
    const _IX_MIN = 2;
    const _IX_MAX = 3;
    const _MAX_IX = 3;
    const _FMT_DT_Y_PFX = '20';

    /**
     * hydrate historic item
     * @param \DOMNode $node
     * @param integer $ixpr
     * @return HistoricInterface
     */
    public function domHydrateHistoric(\DOMNode $node, int $ixpr): HistoricInterface;

    /**
     * return historic date
     * @return string
     */
    public function getDate(): string;

    /**
     * set hitoric date
     * @param string $date
     * @return HistoricInterface
     */
    public function setDate(string $date): HistoricInterface;
}
