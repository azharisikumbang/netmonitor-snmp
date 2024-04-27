<?php

namespace App\Core\Contract;

interface ResponseInterface
{
    public function render(string $template, string $content, array $headers = []): void;

    public function redirect(string $to, mixed $message = null, bool $permanent = true): void;
}