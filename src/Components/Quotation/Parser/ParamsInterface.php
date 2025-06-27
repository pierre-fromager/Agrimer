<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation\Parser;

interface ParamsInterface
{
    /**
     * set market id
     * @param string $id
     * @return ParamsInterface
     */
    public function setMarketId(string $marketId): ParamsInterface;

    /**
     * get market id
     * @return string
     */
    public function getMarketId(): string;

    /**
     * set url
     * @param string $url
     * @return ParamsInterface
     */
    public function setUrl(string $uri): ParamsInterface;

    /**
     * set xquery
     * @param string $query
     * @return ParamsInterface
     */
    public function setQuery(string $query): ParamsInterface;

    /**
     * return xpath query stringg
     * @return string
     */
    public function getQuery(): string;

    /**
     * return final url endpoint
     * @return string
     */
    public function getUrl(): string;

    /**
     * get request method
     * @param string $method
     * @return ParamsInterface
     */
    public function setMethod(string $method): ParamsInterface;

    /**
     * get request method
     * @return string
     */
    public function getMethod(): string;

    /**
     * get request vaviables
     * @return array
     */
    public function getVars(): array;

    /**
     * set request vaviables
     * @param array $vars
     * @return ParamsInterface
     */
    public function setVars(array $vars): ParamsInterface;
}
