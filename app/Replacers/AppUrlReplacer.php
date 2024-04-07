<?php

namespace App\Replacers;

/**
 * Replace {{ app_url }} with input string
 */
final class AppUrlReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/{{ app_url }}/si',
            $this->replace,
            $original
        );
    }
}
