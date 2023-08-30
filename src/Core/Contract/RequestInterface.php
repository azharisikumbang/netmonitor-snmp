<?php

namespace App\Core\Contract;

interface RequestInterface
{
    public function has(string $key): bool;

    public function get(string $key): mixed;

    public function all(): array;
}