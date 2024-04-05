<?php

use App\Replacers\DocsLinkReplacer;

it('run DocsLinkReplacer', function () {
    $html = '<li><a href="/docs/{{version}}/valet">Valet</a></li>';

    $expected = '<li><a href="valet">Valet</a></li>';

    expect(
        (new DocsLinkReplacer(''))->run($html)
    )->toBe($expected);
});

it('run DocsLinkReplacer with urlencode', function () {
    $html = '<li><a href="/docs/%7B%7Bversion%7D%7D/valet">Valet</a></li>';

    $expected = '<li><a href="valet">Valet</a></li>';

    expect(
        (new DocsLinkReplacer(''))->run($html)
    )->toBe($expected);
});
