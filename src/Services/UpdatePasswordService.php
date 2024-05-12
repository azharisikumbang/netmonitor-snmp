<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UpdatePasswordService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function updateUserPassword(string $password, string $confirmation): bool
    {
        if ($password != $confirmation)
            return false;

        if ($password == '' || $confirmation == '')
            return false;

        $owner = session()->user();

        return $this->userRepository->update(
            $owner,
            ['password' => password_hash($password, PASSWORD_DEFAULT)]
        );
    }
}