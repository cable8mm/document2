<?php

namespace App\Replacers;

final class CanonicalReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/{{ canonical }}/si',
            $this->replace,
            $original
        );
    }
}
