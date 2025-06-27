<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

use PierInfor\Agrimer\Components\Http\Fetch;
use PierInfor\Agrimer\Components\Quotation\Parser\ParamsInterface;
use PierInfor\Agrimer\Components\Quotation\LoaderInterface;

/**
 * Market quotation loader
 */
class Loader implements LoaderInterface
{
    /** @var string */
    protected $marketId;

    /** @var Fetch */
    protected $fetch;

    /** @var \DOMDocument */
    protected $dom;

    /** @var ParamsInterface */
    protected $params;

    /** @var bool */
    protected $error;

    /** @var string */
    protected $errMsg;

    /**
     * ctor
     * @param ParamsInterface $params
     */
    public function __construct(ParamsInterface $params)
    {
        $this->setParams($params);
    }

    /**
     * set parameters
     * @param ParamsInterface $params
     * @return LoaderInterface
     */
    public function setParams(ParamsInterface $params): LoaderInterface
    {
        $this->params = $params;
        return $this;
    }


    /**
     * get parameters
     * @return ParamsInterface
     */
    public function getParams(): ParamsInterface
    {
        return $this->params;
    }

    /**
     * init loader
     * @return LoaderInterface
     */
    protected function initLoader(): LoaderInterface
    {
        $this->error = false;
        $this->errMsg = '';
        $this->fetch = (new Fetch());
        libxml_use_internal_errors(true);
        $this->dom = new \DOMDocument();
        return $this;
    }

    /**
     * load quotations from url
     * @return LoaderInterface
     */
    public function load(): LoaderInterface
    {
        $this->initLoader();
        try {
            $this->fetch
                ->setMethod($this->getParams()->getMethod())
                ->setUrl($this->getParams()->getUrl())
                ->setVars($this->getParams()->getVars())
                ->execute();
            $this->dom->loadHTML($this->fetch->getContent());
        } catch (\Exception $e) {
            $this->error = true;
            $this->errMsg = $e->getMessage();
        }
        return $this;
    }

    /**
     * return error
     * @return boolean
     */
    public function error(): bool
    {
        return $this->error;
    }

    /**
     * return error message
     * @return string
     */
    public function errorMsg(): string
    {
        return $this->errMsg;
    }

    /**
     * get DOM Document
     * @return \DOMDocument
     */
    public function getDom()
    {
        return $this->dom;
    }
}
