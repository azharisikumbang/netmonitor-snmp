<?php

namespace App\Core;

use App\Core\Contract\RequestInterface;
use App\Core\Contract\ResponseInterface;
use App\Core\Contract\RouterInterface;

class Router implements RouterInterface
{
    const PATH_QUERY_NAME = 'path';

    private string $pagesLocation;

    private string $path;

    private bool $found = false;

    private string $page = "";

    public function __construct(
        private readonly RequestInterface $request
    ){}

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getContent(): mixed
    {
        return $this->page;
    }

    public function build(): RouterInterface
    {
        $path = rtrim($this->getPath(), DIRECTORY_SEPARATOR);
        if(false === $this->isPageExists($path)) return $this->makeNotFound();

        $this->found = true;
        $this->page = sprintf("%s/%s.php", $this->pagesLocation, $path);

        return $this;
    }

    public function getPath() : string
    {
        return $this->request->get(self::PATH_QUERY_NAME) ?? 'home';
    }

    /**
     * @throws \Exception
     */
    public function setPagesLocation(string $location) : self
    {
        if (file_exists($location)) {
            $this->pagesLocation = rtrim($location, DIRECTORY_SEPARATOR);

            return $this;
        }

        throw new \Exception("System Error: Pages directory doesnt exists.");
    }

    private function isPageExists(string $page): bool
    {
        return file_exists(sprintf("%s/%s.php", $this->pagesLocation, $page));
    }

    private function makeNotFound(): self
    {
        $page = sprintf("%s/static/404.php", $this->pagesLocation);
        if(file_exists($page)) $this->page = $page;

        return $this;
    }
}