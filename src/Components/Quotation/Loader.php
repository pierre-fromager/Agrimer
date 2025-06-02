<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Quotation\Parser\ParamsInterface;
use PierInfor\Agrimer\Components\Quotation\LoaderInterface;

/**
 * Market quotation loader
 */
class Loader implements LoaderInterface
{
    /** @var string */
    protected $marketId;
    /** @var \DOMDocument */
    protected $dom;
    /** @var ParamsInterface */
    protected $params;

    /**
     * ctor
     * @param ParamsInterface $params
     */
    public function __construct(ParamsInterface $params)
    {
        $this->params = $params;
    }

    /**
     * load quotations from url
     * @return LoaderInterface
     */
    public function load(): LoaderInterface
    {
        $this->initLoader();
        $this->dom->loadHTMLFile($this->getUrl());
        return $this;
    }

    /**
     * get DOM Document
     * @return \DOMDocument
     */
    public function getDom()
    {
        return $this->dom;
    }

    /**
     * loader initializer
     * @return LoaderInterface
     */
    protected function initLoader(): LoaderInterface
    {
        libxml_use_internal_errors(true);
        $this->dom = new \DOMDocument();
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
}
