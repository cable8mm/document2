<?php

use App\Replacers\DocsLinkReplacer;

test('NavigationReplacer', function () {
    $html = '<li><a href="/docs/{{version}}/valet">Valet</a></li>';

    $expected = '<li><a href="valet">Valet</a></li>';

    expect(
        (new DocsLinkReplacer(''))->run($html)
    )->toBe($expected);
});
