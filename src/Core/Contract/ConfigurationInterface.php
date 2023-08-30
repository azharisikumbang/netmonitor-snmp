<?php

namespace App\Core\Contract;

interface ConfigurationInterface
{
    public function get(string $container, string $key): mixed;

    public function add(string $key, mixed $value): void;
}