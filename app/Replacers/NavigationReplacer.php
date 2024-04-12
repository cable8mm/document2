<?php

namespace App\Replacers;

/**
 * Replace <!-- doc.navigation.start -->.+<!-- doc.navigation.end --> with input string
 */
final class NavigationReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/<!-- doc.navigator.start -->.+?<!-- doc.navigator.end -->/si',
            $this->replace,
            $original
        );
    }
}
