<?php

namespace App\Core;

class Configuration implements Contract\ConfigurationInterface
{

    private array $configurations = [];

    public function __construct(array $config = [])
    {
        $this->configurations = $config;
    }

    public function get(string $container, string $key): mixed
    {
        return $this->configurations[$container][$key];
    }

    public function add(string $key, mixed $value): void
    {
        $this->configurations[$key] = $value;
    }

    public function has(string $container, string $key): bool
    {
        return array_key_exists($key, $this->configurations[$container]);
    }
}