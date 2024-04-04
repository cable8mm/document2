<?php

namespace App\Replacers;

/**
 * Replace <!-- doc.content.start -->.+<!-- doc.content.end --> with input string
 */
final class ContentReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/<!-- doc.content.start -->.+<!-- doc.content.end -->/si',
            $this->replace,
            $original
        );
    }
}
