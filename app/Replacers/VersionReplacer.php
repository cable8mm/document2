<?php

namespace App\Replacers;

/**
 * Replace {{ version }} with input string
 */
final class VersionReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/{{ version }}/si',
            $this->replace,
            $original
        );
    }
}
