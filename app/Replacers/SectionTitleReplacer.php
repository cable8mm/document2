<?php

namespace App\Replacers;

/**
 * Replace {{ title }} with input string
 */
final class SectionTitleReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/{{ section_title }}/si',
            $this->replace,
            $original
        );
    }
}
