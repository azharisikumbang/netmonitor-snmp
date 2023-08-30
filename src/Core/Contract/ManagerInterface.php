<?php

namespace App\Core\Contract;

interface ManagerInterface
{
    public function getRouter(): RouterInterface;

    public function getSession(): SessionInterface;

    public function getRequest(): RequestInterface;

    public function getResponse(): ResponseInterface;

    public function getConfiguration(): ConfigurationInterface;

    public function getDatabase(): DatabaseInterface;

    public function getTemplate(): TemplateInterface;
}