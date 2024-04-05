<?php

use App\Drivers\LaravelDriver;
use App\Enums\NavEnum;
use App\Types\Nav;
use App\Types\NavCollection;

it('creates a new instance', function () {
    $driver = new LaravelDriver();

    expect($driver)->toBeInstanceOf(LaravelDriver::class);
});

it('run getNavs', function () {
    expect(
        LaravelDriver::getNavs('10.x', 'artisan.md')
    )->toBeInstanceOf(NavCollection::class);
});

it('run getNavFile', function () {
    expect(
        LaravelDriver::getNavFile()
    )->toBe('documentation.md');
});

it('run getDocument', function () {
    [$title, $markdown] = LaravelDriver::getDocument('10.x', 'artisan.md');

    expect(
        $title
    )->toBe('Artisan Console');

    expect(
        (string) $markdown
    )->toBeString();

});

it('run getNavHtml', function () {
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
        (string) LaravelDriver::getNavHtml($navCollection)
    )->toBeString();
});
