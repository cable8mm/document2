<?php

use App\Replacers\NavigationReplacer;

test('NavigationReplacer', function () {
    $html = '
AAA
<!-- doc.navigator.start -->
BBB
<!-- doc.navigator.end -->
CCC';

    $expected = '
AAA
replace
CCC';

    expect(
        (new NavigationReplacer('replace'))->run($html)
    )->toBe($expected);
});
