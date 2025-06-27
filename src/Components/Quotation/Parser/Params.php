<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation\Parser;

use PierInfor\Agrimer\Components\Http\FetchInterface;
use PierInfor\Agrimer\Components\Quotation\Parser\ParamsInterface;

/**
 * params for parser
 */
class Params implements ParamsInterface
{
    /** @var string */
    protected $url;
    /** @var string */
    protected $query;
    /** @var string */
    protected $marketId;
    /** @var string */
    protected $method;
    /** @var array */
    protected $vars;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->setMethod(FetchInterface::_GET_METHOD)->setVars([]);
    }

    /**
     * set market id
     * @param string $id
     * @return ParamsInterface
     */
    public function setMarketId(string $id): ParamsInterface
    {
        $this->marketId = $id;
        return $this;
    }

    /**
     * get market id
     * @return string
     */
    public function getMarketId(): string
    {
        return $this->marketId;
    }

    /**
     * set xquery
     * @param string $query
     * @return ParamsInterface
     */
    public function setQuery(string $query): ParamsInterface
    {
        $this->query = $query;
        return $this;
    }

    /**
     * return xpath query stringg
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * return final url endpoint
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * set final url endpoint
     * @param string $url
     * @return ParamsInterface
     */
    public function setUrl(string $url): ParamsInterface
    {
        $this->url = $url;
        return $this;
    }

    /**
     * get request method
     * @param string $method
     * @return ParamsInterface
     */
    public function setMethod(string $method): ParamsInterface
    {
        $this->method = $method;
        return $this;
    }

    /**
     * get request method
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * get request vaviables
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * set request vaviables
     * @param array $vars
     * @return ParamsInterface
     */
    public function setVars(array $vars): ParamsInterface
    {
        $this->vars = $vars;
        return $this;
    }
}
