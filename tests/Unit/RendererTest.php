<?php

use App\Replacers\ContentReplacer;
use App\Replacers\NavigationReplacer;
use App\Support\Renderer;

test('example', function () {
    $html = '
AAA
<!-- doc.content.start -->
BBB
<!-- doc.content.end -->
CCC
<!-- doc.navigation.start -->
DDD
<!-- doc.navigation.end -->
EEE';

    $expected = '
AAA
content replace string
CCC
navigation replace string
EEE';

    $actual = (new Renderer($html))->register([
        new NavigationReplacer('navigation replace string'),
        new ContentReplacer('content replace string'),
    ])->render();

    expect($actual)->toBe($expected);
});
