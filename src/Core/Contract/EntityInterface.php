<?php

namespace App\Core\Contract;

interface EntityInterface
{
    public function getId(): int|null;

    public function setId(int $id): self;

    public function toArray(): array;
}