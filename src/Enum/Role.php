<?php

namespace App\Enum;

enum Role: string
{
    case ADMINISTRATOR = 'ADMINISTRATOR';

    case OPERATOR = 'OPERATOR';

    case TECHNICIAN = 'TECHNICIAN';

    case PUBLIC = 'PUBLIC';

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

    public function displayAs()
    {
        return match ($this)
        {
            Role::ADMINISTRATOR => 'Administrator',
            Role::OPERATOR => 'Operator',
            Role::TECHNICIAN => 'Teknisi Lapangan',
            default => 'Tanpa Grup'
        };
    }
}