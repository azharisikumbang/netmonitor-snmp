<?php

namespace App\Repositories;

use App\Core\Contract\EntityInterface;
use App\Entities\User;
use App\Enum\Role;
use DateTimeImmutable;


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
        $user->setName($rows['name']);
        $user->setUsername($rows['username']);
        $user->setPassword($rows['password'], true);
        $user->setRole(Role::from($rows['role']));
        $user->setCreatedAt(new DateTimeImmutable($rows['created_at']));

        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        return $this->findBy('username', $username);
    }
}
