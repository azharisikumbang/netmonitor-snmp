<?php

namespace App\Entities\Traits;

use DateTimeImmutable;
use DateTimeInterface;

trait HasTimestamp
{
    private DateTimeImmutable $createdAt;

    private ?DateTimeImmutable $updatedAt;

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
