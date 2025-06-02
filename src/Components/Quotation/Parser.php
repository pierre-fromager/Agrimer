<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\Loader;
use PierInfor\Agrimer\Components\Quotation\Item;
use PierInfor\Agrimer\Components\Quotation\Parser\ParamsInterface;

/**
 * Market quotation parser
 */
class Parser extends Loader
{
    /** @var string */
    protected $marketId;
    /** @var \DOMXPath */
    protected $xpath;
    /** @var ParamsInterface */
    protected $params;
    /** @var array */
    protected $collection;
    /** @var Item */
    protected $item;
    /** @var int */
    protected $iix;

    /**
     * ctor
     * @param ParamsInterface $params
     */
    public function __construct(ParamsInterface $params)
    {
        $this->params = $params;
        $this->collection = [];
    }

    /**
     * parser initializer
     * @return Parser
     */
    protected function initParser(): Parser
    {
        $this->load();
        $this->xpath =  new \DOMXPath($this->getDom());
        $this->item = new Item();
        $this->collection = [];
        return $this;
    }

    /**
     * market quotations urls
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->params->getUrl();
    }

    /**
     * process item
     * @param \DOMNode $node
     * @param int $ix
     * @return Parser
     */
    protected function processItem(\DOMNode $node): Parser
    {
        if ($this->iix == 0) {
            $this->item = new Item();
        }
        $ct = $node->textContent;
        switch ($this->iix) {
            case ItemInterface::_IX_LABEL:
                $this->item->setLabel($ct);
                break;
            case ItemInterface::_IX_VALUE:
                $this->item->setValue($ct);
                break;
            case ItemInterface::_IX_VARIA:
                $this->item->setVaria($ct);
                break;
            case ItemInterface::_IX_MIN:
                $this->item->setMin($ct);
                break;
            case ItemInterface::_IX_MAX:
                $this->item->setMax($ct);
                break;
        }
        $this->iix++;
        if ($this->iix > 4) {
            $this->item->setMarketId($this->params->getMarketId());
            $this->collection[] = $this->item;
            $this->iix = 0;
        }
        return $this;
    }

    /**
     * parse quotations to form collection
     * @return Parser
     */
    public function parse(): Parser
    {
        $this->initParser();
        $nodes = $this->xpath->query($this->params->getQuery());
        $this->iix = 0;
        foreach ($nodes as $node) {
            $this->processItem($node);
        }
        return $this;
    }

    /**
     * returns quotations list
     * @return array
     */
    public function list(): array
    {
        return $this->collection;
    }
}
