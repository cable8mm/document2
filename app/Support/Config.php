<?php

namespace App\Support;

class Config
{
    public static function versions(): array
    {
        return config('document2.versions');
    }
}
