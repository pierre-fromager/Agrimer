<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\Loader;
use PierInfor\Agrimer\Components\Quotation\Product;
use PierInfor\Agrimer\Components\Quotation\Parser\ParamsInterface;

/**
 * Market quotation parser
 */
class QuotationParser extends Loader
{
    /** @var string */
    protected $marketId;

    /** @var \DOMXPath */
    protected $xpath;

    /** @var ParamsInterface */
    protected $params;

    /** @var array */
    protected $collection;

    /** @var Product */
    protected $product;

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
     * @return QuotationParser
     */
    protected function initParser(): QuotationParser
    {
        $this->load();
        $this->xpath =  new \DOMXPath($this->getDom());
        $this->product = new Product();
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
     * process product
     * @param \DOMNode $node
     * @return QuotationParser
     */
    protected function processProduct(\DOMNode $node): QuotationParser
    {
        if ($this->ixpr == 0) {
            $this->product = new Product();
        }
        $this->product->domHydrate($node, $this->ixpr);
        $this->ixpr++;
        if ($this->ixpr > ProductInterface::_MAX_IX) {
            $this->product->setMarketId($this->params->getMarketId());
            $this->collection[] = $this->product;
            $this->ixpr = 0;
        }
        return $this;
    }

    /**
     * parse quotations to form collection
     * @return Parser
     */
    public function parse(): QuotationParser
    {
        $this->initParser();
        $nodes = $this->xpath->query($this->params->getQuery());
        $this->ixpr = 0;
        foreach ($nodes as $node) {
            $this->processProduct($node);
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
