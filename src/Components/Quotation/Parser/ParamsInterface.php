<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation\Parser;

// const URL_PROTO = 'https://';
// const URL_HOST = 'rnm.franceagrimer.fr';
// const URL_SFX = '.franceagrimer.fr';
// const XPATH_QUERY = '//table[@id=\'tabcotmar\']/tbody/tr/td';

interface ParamsInterface
{
    public function setProto(string $proto): ParamsInterface;
    public function setHost(string $host): ParamsInterface;
    public function setMarketId(string $marketId): ParamsInterface;
    public function getMarketId(): string;
    public function setUri(string $uri): ParamsInterface;
    public function setQuery(string $query): ParamsInterface;
    public function getQuery(): string;
    public function getUrl(): string;
}
