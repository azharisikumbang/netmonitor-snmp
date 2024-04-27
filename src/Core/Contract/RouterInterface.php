<?php

namespace App\Core\Contract;

interface RouterInterface
{
    public function getContent(): mixed;

    public function build(): self;

    public function getResponse(): ResponseInterface;

    public function getPath(): string;
}