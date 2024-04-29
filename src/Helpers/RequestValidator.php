<?php

namespace App\Helpers;

class RequestValidator
{
    public static function isNullOrEmpty(mixed $data): bool
    {
        $data = is_string($data) ? trim($data) : $data;

        return ((is_null($data)) || ($data == ""));
    }
}