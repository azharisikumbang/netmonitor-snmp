<?php

namespace App\Core\Contract;

interface ResponseInterface
{
    public function render(string $template, string $content, array $headers = []): void;
}