<?php

use App\Enums\NavEnum;
use App\Types\Nav;
use App\Types\NavCollection;

test('run NavCollection', function () {
    $navCollection = new NavCollection([
        new Nav('Section 1', NavEnum::Section),
        new Nav('Title11', NavEnum::Page, '/docs/title11'),
        new Nav('Title12', NavEnum::Page, '/docs/title12'),
        new Nav('Title13', NavEnum::Page, '/docs/title13'),
        new Nav('Title14', NavEnum::Page, '/docs/title14'),
        new Nav('Title15', NavEnum::Page, '/docs/title15'),
        new Nav('Title16', NavEnum::Page, '/docs/title16'),
        new Nav('Section 2', NavEnum::Section),
        new Nav('Title21', NavEnum::Page, '/docs/title21'),
        new Nav('Title22', NavEnum::Page, '/docs/title22'),
        new Nav('Title23', NavEnum::Page, '/docs/title23'),
        new Nav('Title24', NavEnum::Page, '/docs/title24'),
        new Nav('Title25', NavEnum::Page, '/docs/title25'),
    ], 'title15.md');

    expect(
        $navCollection->toArray()
    )->toBeArray();
});
