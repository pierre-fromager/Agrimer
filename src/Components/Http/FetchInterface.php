<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Http;

interface FetchInterface
{
    const _CR = "\r\n";
    const _GET_METHOD = 'GET';
    const _POST_METHOD = 'POST';
    const _UA = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36' . self::_CR;
    const _POST_HEADER = self::_UA .  'Content-Type: application/x-www-form-urlencoded' . self::_CR;
    const _GET_HEADER = self::_UA .  'Accept-language: fr' . self::_CR;
    const _ERROR_REQ_MSG = 'Error Processing Request';

    /**
     * use post query method to set content
     * @return FetchInterface
     */
    public function execute(): FetchInterface;

    /**
     * get request content
     * @return string
     */
    public function getContent(): string;

    /**
     * set request method
     * @param string $method
     * @return FetchInterface
     */
    public function setMethod(string $method): FetchInterface;

    /**
     * set request vars
     * @param array $vars
     * @return FetchInterface
     */
    public function setVars(array $vars): FetchInterface;

    /**
     * set request url
     * @param string $url
     * @return FetchInterface
     */
    public function setUrl(string $url): FetchInterface;
}
