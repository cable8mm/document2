<?php

namespace App\Replacers;

/**
 * Replace `/docs/{{version}}/frontend` to `frontend`
 */
final class DocsLinkReplacer extends Replacer
{
    public function run(string $original): string
    {
        return preg_replace(
            '/\/docs\/{{version}}\//si',
            $this->replace,
            $original
        );
    }
}
