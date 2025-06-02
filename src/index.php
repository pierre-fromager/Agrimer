<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\Parser as QuotationParser;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;

$places = new MarketPlaces();
$marketsId = $places->listIds();
$collection  = [];
foreach ($marketsId as $marketId) {
    $parser = new QuotationParser(
        (new ParserParams())
            ->setProto('https://')
            ->setHost('rnm.franceagrimer.fr')
            ->setUri("/prix?$marketId:MARCHE")
            ->setMarketId($marketId)
            ->setQuery('//table[@id=\'tabcotmar\']/tbody/tr/td')
    );
    $collection = array_merge($collection, $parser->parse()->list());
}

$filter = '/(courgette|tomate)/im';
$collection = array_filter($collection, function ($v) use ($filter) {
    return preg_match_all($filter, $v->getLabel());
}, ARRAY_FILTER_USE_BOTH);
$json = json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
unset($collection);

header('Content-Type: application/json; charset=utf-8');
echo $json;
