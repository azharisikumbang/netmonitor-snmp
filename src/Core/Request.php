<?php

namespace App\Core;

use App\Core\Contract\RequestInterface;
use App\Core\Contract\SessionInterface;

class Request implements RequestInterface
{
    public function __construct(private readonly array $data)
    {}

    public function has(string $key): bool
    {
        $searched = (!is_array($key)) ? [$key] : $key;

        foreach ($searched as $search) {
            if (!in_array($search, array_keys($this->all()))) return false;
        }

        return true;
    }

    public function get(string $key): mixed
    {
        return $_REQUEST[$key] ?? null;
    }

    public function all(): array
    {
        return $this->data;
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function isPostRequest() : bool
    {
        return strtolower($_SERVER['REQUEST_METHOD'])  === 'post';
    }

    public function isGetRequest() : bool
    {
        return strtolower($_SERVER['REQUEST_METHOD']) === 'get';
    }
}