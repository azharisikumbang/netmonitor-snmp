<?php

namespace App\Entities;

use App\Core\Contract\EntityInterface;
use App\Enum\Role;

class User implements EntityInterface
{
    use Traits\HasTimestamp;

    private int $id;

    private string $name;

    private ?string $contact;

    private ?string $address;

    private string $username;

    private string $password;

    private Role $role;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $username
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string $username
     */
    public function setContact(?string $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $username
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }


    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password, bool $hashed = false): void
    {
        if (false === $hashed)
            $password = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRole(): ?Role
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'contact' => $this->getContact(),
            'address' => $this->getAddress(),
            'username' => $this->getUsername(),
            'role' => $this->getRole()->value
        ];
    }
}