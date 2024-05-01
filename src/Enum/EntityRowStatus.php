<?php

namespace App\Enum;

enum EntityRowStatus: string
{
    case ACTIVE = "ACTIVE";

    case NONACTIVE = "NONACTIVE";

    public function displayAs(): string
    {
        return match ($this)
        {
            self::ACTIVE => "Aktif",
            self::NONACTIVE => "Nonaktif",

            default => "Nonaktif"
        };
    }
}