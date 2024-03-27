<?php

use App\Replacers\ContentReplacer;

test('ContentReplacer', function () {
    $html = '
AAA
<!-- doc.content.start -->
BBB
<!-- doc.content.end -->
CCC';

    $expected = '
AAA
replace
CCC';

    expect(
        (new ContentReplacer('replace'))->run($html)
    )->toBe($expected);
});
