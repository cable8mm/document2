<?php

namespace App\Replacers;

/**
 * Replace `/docs/{{version}}/frontend` to `frontend`
 */
final class DocsLinkReplacer extends Replacer
{
    public function run(string $original): string
    {
        $patterns = [
            '/\/docs\/{{version}}\//si',
            '/\/docs\/%7B%7Bversion%7D%7D\//si',
        ];

        return preg_replace(
            $patterns,
            $this->replace,
            $original
        );
    }
}
