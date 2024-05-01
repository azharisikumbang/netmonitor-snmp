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
        $user->setContact($rows['contact']);
        $user->setAddress($rows['address']);
        $user->setUsername($rows['username']);
        $user->setPassword($rows['password'], true);
        $user->setRole(Role::from($rows['role']));
        $user->setCreatedAt(new DateTimeImmutable($rows['created_at']));
        $user->setUpdatedAt(
            $rows['updated_at'] ? new DateTimeImmutable($rows['updated_at']) : null
        );

        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        $user = $this->findBy('username', $username);

        return $user ? $user[0] : null;
    }
}
