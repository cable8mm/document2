<?php

namespace App\Replacers;

use App\Support\Config;

/**
 * Replace {{ original_url }} with input string
 */
final class OriginalUrlReplacer extends Replacer
{
    public function run(string $original): string
    {
        $versions = Config::get('versions');

        $escapes = array_map(fn ($item) => preg_quote($item, '/'), $versions);

        $patterns = [
            '/(href=["\'])\/(?!'.implode('|', $escapes).')/si',
            '/{{ original_url }}/si',
        ];

        $original = preg_replace(
            $patterns[0],
            '$1'.$this->replace.'/',
            $original
        );

        return preg_replace(
            $patterns[1],
            $this->replace,
            $original
        );
    }
}
