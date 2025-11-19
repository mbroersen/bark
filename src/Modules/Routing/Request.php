<?php

namespace Bark\Modules\Routing;

class Request
{

    public string $method {
        get {
            return $this->method;
        }
    }

    public string $uri {
        get {
            return parse_url($this->uri, PHP_URL_PATH);
        }
    }
    public array $headers {
        get {
            return $this->headers;
        }
    }
    public array $queryParams {
        get {
            return $this->queryParams;
        }
    }
    public array $postParams {
        get {
            return $this->postParams;
        }
    }
    public string $body {
        get {
            return $this->body;
        }
    }

    public bool $isFileUpload {
        get {
            return !empty($this->files);
        }
    }

    private array $files = [];


    public function __construct()
    {
        $this->parseRequest();
    }

    private function parseRequest(): void
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->headers = getallheaders();
        $this->queryParams = $_GET ?? [];
        $this->postParams = $_POST ?? [];

        // parse body from request to json object
        $this->body = json_decode(file_get_contents('php://input') ?? '[]', JSON_UNESCAPED_UNICODE);

        // check if file upload
        if (!empty($_FILES)) {
            $this->files = $_FILES;
            $this->postParams = array_merge($this->postParams, $_FILES);
        }
    }

    public function param($name, $default = null): int|array|string
    {
        return $this->queryParams[$name] ?? $default;
    }

    public function postValue($name, $default = null): int|array|string
    {
        return $this->postParams[$name] ?? $this->body[$name] ?? $default;
    }
}