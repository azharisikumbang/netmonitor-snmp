<?php

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepository;

class AuthenticatorService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function check(string $username, string $password): false|User
    {
        $user = $this->userRepository->findByUsername($username);
        if (is_null($user))
            return false;

        return password_verify($password, $user->getPassword()) ? $user : false;

    }
}