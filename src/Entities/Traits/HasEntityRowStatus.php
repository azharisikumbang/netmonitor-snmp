<?php

namespace App\Entities\Traits;

use App\Enum\EntityRowStatus;

trait HasEntityRowStatus
{
    protected bool $hasEntityRowStatus = true;

    private EntityRowStatus $entityRowStatus;

    public function setEntityRowStatus(EntityRowStatus $entityRowStatus): self
    {
        $this->entityRowStatus = $entityRowStatus;

        return $this;
    }

    public function getEntityRowStatus(): EntityRowStatus
    {
        return $this->entityRowStatus;
    }
}