<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\CommonInterface;
use PierInfor\Agrimer\Components\Quotation\Common;
use PierInfor\Agrimer\Components\Serializer\JsonSerializer;

/**
 * Agrimer historic quotation product
 */
class Historic extends Common implements HistoricInterface, \JsonSerializable
{
    use JsonSerializer;

    /** @var string */
    protected $date;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->initCommon();
    }

    /**
     * initialize historic item
     * @return HistoricInterface
     */
    protected function initCommon(): HistoricInterface
    {
        parent::__construct();
        return $this;
    }

    /**
     * hydrate historic from node
     * @param \DOMNode $node
     * @param integer $ixpr
     * @return HistoricInterface
     */
    public function domHydrateHistoric(\DOMNode $node, int $ixpr): HistoricInterface
    {
        $ct = $node->textContent;
        switch ($ixpr) {
            case HistoricInterface::_IX_DATE:
                $this->setDate($ct);
                break;
            case HistoricInterface::_IX_VALUE:
                $this->setValue($ct);
                break;
            case HistoricInterface::_IX_MIN:
                $this->setMin($ct);
                break;
            case HistoricInterface::_IX_MAX:
                $this->setMax($ct);
                break;
        }
        return $this;
    }

    /**
     * return historic date
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * set hitoric date
     * @param string $date
     * @return HistoricInterface
     */
    public function setDate(string $date): HistoricInterface
    {
        $this->date = $this->getFormatedDate($date);
        return $this;
    }

    /**
     * return us formated date from DD/MM/YY to YYYY-MM-DD
     * @param string $dt
     * @return string
     */
    protected function getFormatedDate(string $dt): string
    {
        $parts = array_reverse(explode('/', str_replace(' ', '', $dt)));
        $parts[0] = HistoricInterface::_FMT_DT_Y_PFX . $parts[0];
        return implode('-', $parts);
    }
}
