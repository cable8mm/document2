<?php

use App\Replacers\NavigationReplacer;

test('NavigationReplacer', function () {
    $html = '
AAA
<!-- doc.navigation.start -->
BBB
<!-- doc.navigation.end -->
CCC';

    $expected = '
AAA
replace
CCC';

    expect(
        (new NavigationReplacer('replace'))->run($html)
    )->toBeString($expected);
});
