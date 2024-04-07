<?php

use App\Replacers\DocsLinkReplacer;

it('run DocsLinkReplacer', function () {
    $html = '<li><a href="/docs/{{version}}/valet">Valet</a></li>';

    expect(
        (new DocsLinkReplacer('/10.x/'))->run($html)
    )->toBe('<li><a href="/10.x/valet">Valet</a></li>');
});

it('run DocsLinkReplacer with urlencode', function () {
    $html = '<li><a href="/docs/%7B%7Bversion%7D%7D/valet">Valet</a></li>';

    expect(
        (new DocsLinkReplacer('/10.x/'))->run($html)
    )->toBe('<li><a href="/10.x/valet">Valet</a></li>');
});
