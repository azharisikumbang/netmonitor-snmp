<?php

namespace App\Enum;

enum Role: string
{
    case ADMINISTRATOR = 'administrator';

    case OPERATOR = 'operator';

    case TECHNICIAN = 'technician';

    case PUBLIC = 'public';

    public function pageTemplate()
    {
        return match ($this)
        {
            Role::ADMINISTRATOR => 'administrator',
            Role::OPERATOR => 'operator',
            Role::TECHNICIAN => 'technician',
            default => 'public'
        };
    }

    public function redirectPage()
    {
        return match ($this)
        {
            Role::ADMINISTRATOR => 'administrator/dashboard',
            Role::OPERATOR => 'operator/dashboard',
            Role::TECHNICIAN => 'technician/dashboard',
            default => 'public'
        };
    }
}