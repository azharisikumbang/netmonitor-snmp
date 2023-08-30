<?php

namespace App\Core;

class Response implements Contract\ResponseInterface
{
    public function render(string $template, string $content, array $headers = []): void
    {
        if (file_exists($template)) require_once $template;
        else {
            throw new \RuntimeException('Server Error: Template file for role not found.');
        }
    }
}