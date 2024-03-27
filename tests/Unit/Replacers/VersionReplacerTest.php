<?php

use App\Replacers\VersionReplacer;

test('ContentReplacer', function () {
    $html = '
AAA
Laravel {{ version }} documentation
CCC';

    $expected = '
AAA
Laravel 10.x documentation
CCC';

    expect(
        (new VersionReplacer('10.x'))->run($html)
    )->toBe($expected);
});
