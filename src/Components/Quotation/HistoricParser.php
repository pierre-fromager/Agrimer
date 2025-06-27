<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\Loader;
use PierInfor\Agrimer\Components\Quotation\HistoricInterface;
use PierInfor\Agrimer\Components\Quotation\Historic;
use PierInfor\Agrimer\Components\Quotation\Parser\ParamsInterface;

/**
 * Market historical quotation parser
 */
class HistoricParser extends Loader
{
    /** @var \DOMXPath */
    protected $xpath;

    /** @var ParamsInterface */
    protected $params;

    /** @var array */
    protected $collection;

    /** @var HistoricInterface */
    protected $historic;

    /** @var int */
    protected $ixpr;

    /**
     * ctor
     * @param ParamsInterface $params
     */
    public function __construct(ParamsInterface $params)
    {
        $this->params = $params;
        $this->collection = [];
        $this->ixpr = 0;
    }

    /**
     * parser initializer
     * @return HistoricParser
     */
    protected function initHistoricParser(): HistoricParser
    {
        $this->load();
        $this->xpath =  new \DOMXPath($this->getDom());
        $this->historic = new Historic();
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
     * process historic item product
     * @param \DOMNode $node
     * @return HistoricParser
     */
    protected function processHistoric(\DOMNode $node): HistoricParser
    {
        if ($this->ixpr == 0) {
            $this->historic = new Historic();
        }
        $this->historic->domHydrateHistoric($node, $this->ixpr);
        $this->ixpr++;
        if ($this->ixpr > HistoricInterface::_MAX_IX) {
            $this->collection[] = $this->historic;
            $this->ixpr = 0;
        }
        return $this;
    }

    /**
     * parse quotations to form collection
     * @return Parser
     */
    public function parse(): HistoricParser
    {
        $this->initHistoricParser();
        $nodes = $this->xpath->query($this->params->getQuery());
        $this->ixpr = 0;
        foreach ($nodes as $node) {
            $this->processHistoric($node);
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
