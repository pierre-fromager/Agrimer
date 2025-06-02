<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PierInfor\Agrimer\Components\Market\Place as MarketPlace;
use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\Item as QuotationItem;
use PierInfor\Agrimer\Components\Quotation\Parser as QuotationParser;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;

$places = new MarketPlaces();
$allMarkets = $places->list();

$marketFilter = '/(bio)/im';
$bioMarkets =  array_filter($allMarkets, function (MarketPlace $place) use ($marketFilter) {
    return preg_match_all($marketFilter, $place->label);
}, ARRAY_FILTER_USE_BOTH);

$collection  = [];
foreach ($bioMarkets as $marketPlace) {
    $parser = new QuotationParser(
        (new ParserParams())
            ->setProto('https://')
            ->setHost('rnm.franceagrimer.fr')
            ->setUri("/prix?$marketPlace->id:MARCHE")
            ->setMarketId($marketPlace->id)
            ->setQuery('//table[@id=\'tabcotmar\']/tbody/tr/td')
    );
    $collection = array_merge($collection, $parser->parse()->list());
}

$filter = '/(courgette|tomate)/im';
$collection = array_filter($collection, function (QuotationItem $item) use ($filter) {
    return preg_match_all($filter, $item->getLabel());
}, ARRAY_FILTER_USE_BOTH);
$json = json_encode($collection, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
unset($collection);

header('Content-Type: application/json; charset=utf-8');
echo $json;
