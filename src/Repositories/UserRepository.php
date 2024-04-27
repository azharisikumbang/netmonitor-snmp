<?php

namespace App\Repositories;

use App\Core\Contract\EntityInterface;
use App\Entities\User;
use App\Enum\Role;


class UserRepository extends BaseRepository
{

    protected $table = "users";

    protected function getTable(): string
    {
        return $this->table;
    }

    protected function toEntity(array $rows): EntityInterface
    {
        $user = new User();
        $user->setId($rows['id']);
        $user->setUsername($rows['username']);
        $user->setPassword($rows['password'], true);
        $user->setRole(Role::from(strtolower($rows['role'])));

        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        return $this->findBy('username', $username);
    }
}
