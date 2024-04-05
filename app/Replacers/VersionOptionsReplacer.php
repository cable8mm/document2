<?php

namespace App\Replacers;

/**
 * Replace <!-- doc.navigation.start -->.+<!-- doc.navigation.end --> with input string
 */
final class VersionOptionsReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/<!-- version.options.start -->.+<!-- version.options.end -->/si',
            $this->replace,
            $original
        );
    }
}
