<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation\Parser;

use PierInfor\Agrimer\Components\Quotation\Parser\ParamsInterface;

/**
 * params for parser
 */
class Params implements ParamsInterface
{
    /** @var string */
    protected $proto;
    /** @var string */
    protected $host;
    /** @var string */
    protected $uri;
    /** @var string */
    protected $query;
    /** @var string */
    protected $marketId;

    /**
     * ctor
     */
    public function __construct()
    {
    }

    /**
     * set protocol
     * @param string $proto
     * @return ParamsInterface
     */
    public function setProto(string $proto): ParamsInterface
    {
        $this->proto = $proto;
        return $this;
    }

    /**
     * set host
     * @param string $host
     * @return ParamsInterface
     */
    public function setHost(string $host): ParamsInterface
    {
        $this->host = $host;
        return $this;
    }

    /**
     * set uri
     * @param string $uri
     * @return ParamsInterface
     */
    public function setUri(string $uri): ParamsInterface
    {
        $this->uri = $uri;
        return $this;
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
        return $this->proto . $this->host . $this->uri;
    }
}
