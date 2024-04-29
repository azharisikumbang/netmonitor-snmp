<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function retriveUserList(int $length = 10, int $start = 0, string $search = "", string $role = ""): array
    {
        $start = ($length * $start) - $start;

        if ($search == "" && $role == "")
            return $this->userRepository->get($length, $start, 'role', 'ASC');

        if ($search != "")
            return $this->userRepository->searchBy('name', $search, $length, $start, 'role', 'ASC');

        if ($role != "")
            return $this->userRepository->findBy('role', $role);

        return [];
    }
}