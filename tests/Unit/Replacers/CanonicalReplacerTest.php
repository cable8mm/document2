<?php

use App\Replacers\CanonicalReplacer;

test('NavigationReplacer', function () {
    $html = '
AAA
<link rel="canonical" href="{{ canonical }}" />
CCC';

    $expected = '
AAA
<link rel="canonical" href="https://www.palgle.com/" />
CCC';

    expect(
        (new CanonicalReplacer('https://www.palgle.com/'))->run($html)
    )->toBe($expected);
});
