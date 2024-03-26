<?php

namespace App\Replacers;

final class NavigationReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/<!-- doc.navigation.start -->.+<!-- doc.navigation.end -->/si',
            $this->replace,
            $original
        );
    }
}
