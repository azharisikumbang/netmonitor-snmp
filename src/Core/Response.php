<?php

namespace App\Core;

class Response implements Contract\ResponseInterface
{
    public function render(string $template, string $content, array $headers = []): void
    {
        if (file_exists($template))
            require_once $template;
        else
        {
            throw new \RuntimeException('Server Error: Template file for role not found.');
        }
    }

    public function redirect(string $to, mixed $message = null, bool $permanent = true): void
    {
        if ($message)
            session()->add('temp', $message);
        header('Location: ' . $to, true, $permanent ? 301 : 302);
        exit();
    }

    public function redirectTo(string $to, mixed $message = null, bool $permanent = true): void
    {
        $this->redirect($to, $message, $permanent);
    }

    public function notFound(): void
    {
        http_response_code(404);
        html_not_found();
        exit();
    }
}