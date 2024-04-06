<?php

namespace App\Replacers;

/**
 * Replace {{ title }} with input string
 */
final class TitleReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/{{ title }}/si',
            $this->replace,
            $original
        );
    }
}
