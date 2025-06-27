<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Http;

use PierInfor\Agrimer\Components\Http\FetchInterface;

/**
 * Http fetcher
 */
class Fetch implements FetchInterface
{
    /** @var string $url */
    protected $url;

    /** @var string $method */
    protected $method;

    /** @var array $vars */
    protected $vars;

    /** @var string $content */
    protected $content;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * init request
     * @return FetchInterface
     */
    protected function init(): FetchInterface
    {
        $this->url = '';
        $this->vars = [];
        $this->method = self::_GET_METHOD;
        $this->content = '';
        return $this;
    }

    /**
     * execute request
     * @return FetchInterface
     */
    public function execute(): FetchInterface
    {
        $this->content = file_get_contents(
            $this->url,
            false,
            $this->getContext()
        );
        return $this;
    }

    /**
     * set request url
     * @param string $url
     * @return FetchInterface
     */
    public function setUrl(string $url): FetchInterface
    {
        $this->url = $url;
        return $this;
    }

    /**
     * set request method
     * @param string $method
     * @return FetchInterface
     */
    public function setMethod(string $method): FetchInterface
    {
        $this->method = $method;
        return $this;
    }

    /**
     * set request variables
     * @param array $vars
     * @return FetchInterface
     */
    public function setVars(array $vars): FetchInterface
    {
        $this->vars = $vars;
        return $this;
    }


    /**
     * return content
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * return options
     * @return array
     */
    protected function getOptions(): array
    {
        $opts = [
            'http' =>
            [
                'method'  => $this->method,
                'header'  => ($this->method == self::_POST_METHOD)
                    ? self::_POST_HEADER
                    : self::_GET_HEADER,
                'ignore_errors' => 1,
                'content' => http_build_query($this->vars)
            ]
        ];
        return $opts;
    }

    /**
     * get stream context request
     * @throw \Exception
     * @return resource
     */
    protected function getContext()
    {
        $resource = stream_context_create($this->getOptions());
        $error = is_null($resource) || !is_resource($resource) || empty($this->url);
        if ($error) {
            throw new \Exception(self::_ERROR_REQ_MSG, 1);
        }
        return $resource;
    }
}
