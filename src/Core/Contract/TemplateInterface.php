<?php

namespace App\Core\Contract;

use App\Entities\User;

interface TemplateInterface
{
    public function getTemplate(): string;

    public function setUserTemplateFromConfiguration(User $user, array $roles) : void;
}