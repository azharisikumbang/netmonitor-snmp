<?php

namespace App\Entities\Traits;

use DateTimeImmutable;
use DateTimeInterface;

trait HasTimestamp
{
    private DateTimeImmutable $createdAt;

    private ?DateTimeImmutable $updatedAt;

    protected bool $hasTimestamp = true;

    public function hasTimestamp(): bool
    {
        return $this->hasTimestamp;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function getCreatedAtAsString(string $format = "d-m-Y H:i:s T"): string
    {
        return $this->getCreatedAt() ? $this->getCreatedAt()->format($format) : "-";
    }

    public function getUpdatedAtAsString(string $format = "d-m-Y H:i:s T"): string
    {
        return $this->getUpdatedAt() ? $this->getUpdatedAt()->format($format) : "-";
    }
}
