<?php

namespace App\Services;

use App\Entities\User;
use App\Enum\EntityRowStatus;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function retriveUserList(int $length = 10, int $start = 0, string $search = "", string $role = ""): array
    {
        $start = ($length * $start) - $length;

        if ($search == "" && $role == "")
            return $this->userRepository->get($length, $start, 'role', 'ASC');

        if ($search != "")
            return $this->userRepository->searchBy('name', $search, $length, $start, 'role', 'ASC');

        if ($role != "")
            return $this->userRepository->findBy('role', $role, "=", $length, $start, 'role', 'ASC');

        return [];
    }

    public function getUserDetail(int $idUser): ?User
    {
        return $this->userRepository->findById($idUser);
    }

    public function deactivateUserAccount(int|User $user): bool
    {
        $user = is_int($user) ? $this->userRepository->findById($user) : $user;

        return $this->userRepository->update($user, [
            "entity_row_status" => EntityRowStatus::NONACTIVE->value
        ]);
    }
    public function activateUserAccount(int|User $user): bool
    {
        $user = is_int($user) ? $this->userRepository->findById($user) : $user;

        return $this->userRepository->update($user, [
            "entity_row_status" => EntityRowStatus::ACTIVE->value
        ]);
    }

}