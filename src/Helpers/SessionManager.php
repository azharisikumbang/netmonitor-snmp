<?php

namespace App\Helpers;

use App\Entities\User;

class SessionManager
{
    const AUTH_TOKEN_NAME = 'auth';

    public static function createAuthenticatedSession(User $user): void
    {
        session()->add(self::AUTH_TOKEN_NAME, [
            'created_at' => time(),
            'token' => self::generateAuthToken(),
            'users' => $user
        ]);
    }

    private static function generateAuthToken(int $length = 20): string
    {
        $bytes = random_bytes($length);

        return bin2hex($bytes);
    }
}