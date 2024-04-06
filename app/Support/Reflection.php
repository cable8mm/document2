<?php

namespace App\Support;

use App\Drivers\Driver;
use ReflectionClass;

class Reflection
{
    /**
     * Convert a value to PascalCase.
     *
     * @return string The method returns a PascalCase string
     */
    public static function pascal(string $value): string
    {
        return ucfirst(preg_replace('/[-_]/', ' ', $value));
    }

    /**
     * Get the driver instance
     *
     * @param  string  $template  The template name
     * @return \App\Contracts\DriverInterface The method returns the driver instance
     */
    public static function driver(string $template): \App\Contracts\DriverInterface
    {
        return (new ReflectionClass(
            preg_replace('/Driver$/', self::pascal($template).'Driver', Driver::class)
        ))->newInstance();
    }
}
