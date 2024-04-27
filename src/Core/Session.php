<?php

namespace App\Core;

use App\Enum\Role;
use App\Entities\User;

class Session implements Contract\SessionInterface
{
    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();
    }

    public function all(): array
    {
        return $_SESSION ?? [];
    }

    public function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function add(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function remove(string $key): void
    {
        // TODO: Implement remove() method.
    }

    public function destroy(): void
    {
        // TODO: Implement destroy() method.
    }

    public function exists(string $key): bool
    {
        // TODO: Implement exists() method.
        return true;
    }

    public function auth(): null|array
    {
        return session('auth');
    }
}