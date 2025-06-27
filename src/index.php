<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PierInfor\Agrimer\Components\Http\FetchInterface;
use PierInfor\Agrimer\Components\Market\Place as MarketPlace;
use PierInfor\Agrimer\Components\Market\Places as MarketPlaces;
use PierInfor\Agrimer\Components\Quotation\HistoricParser;
use PierInfor\Agrimer\Components\Quotation\Product as QuotationProduct;
use PierInfor\Agrimer\Components\Quotation\QuotationParser;
use PierInfor\Agrimer\Components\Quotation\Parser\Params as ParserParams;

 $histoParams = (new ParserParams())
        ->setUrl('https://rnm.franceagrimer.fr/prix')
         ->setVars(['LAST' => '', 'LIBCOD' => 57224273])
        ->setMethod(FetchInterface::_POST_METHOD)
        ->setQuery('//table[@class=\'tabcot\']/tbody/tr/td');
$histoParser = (new HistoricParser($histoParams))->parse();
var_dump($histoParser->list());
die;
$places = new MarketPlaces();
$allMarkets = $places->list();
// $marketFilter = '/(bordeaux.*(bio))|(lyon.*(légumes))/im'; // '/(bio)/im';
$marketFilter = '/(bio)/im'; // '/(bio)/im';
$markets =  array_filter($allMarkets, function (MarketPlace $place) use ($marketFilter) {
    return preg_match_all($marketFilter, $place->getLabel());
}, ARRAY_FILTER_USE_BOTH);

$collection  = [];
foreach ($markets as $marketPlace) {
    $id =  $marketPlace->getId();
    $url = 'https://rnm.franceagrimer.fr/prix?' . $id . ':MARCHE';
    $params = (new ParserParams())
        ->setUrl($url)
        ->setVars([])
        ->setMethod(FetchInterface::_GET_METHOD)
        ->setMarketId($id)
        ->setQuery('//table[@id=\'tabcotmar\']/tbody/tr/td');
    $parser = new QuotationParser($params);
    $collection = array_merge($collection, $parser->parse()->list());
}

$filter = '/(courgette|tomate)/im';
$collection = array_filter($collection, function (QuotationProduct $item) use ($filter) {
    return preg_match_all($filter, $item->getLabel());
}, ARRAY_FILTER_USE_BOTH);


$result = new \stdClass();
$result->markets = $markets;
$result->products = $collection;
$json = json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
unset($collection);

header('Content-Type: application/json; charset=utf-8');
echo $json;
