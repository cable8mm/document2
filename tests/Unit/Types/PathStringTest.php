<?php

use App\Types\PathString;

it('run toPath', function () {
    expect(
        (new PathString('/Users/cable8mm/Sites/document2/public/10.x/artisan.md'))->toPath()
    )->toBe('/Users/cable8mm/Sites/document2/public/10.x/artisan.md');
});

it('run toDir', function () {
    expect(
        (new PathString('/Users/cable8mm/Sites/document2/public/10.x/artisan.md'))->toDir()
    )->toBe('/Users/cable8mm/Sites/document2/public/10.x/artisan');
});

it('run toLocation', function () {
    expect(
        (new PathString('/Users/cable8mm/Sites/document2/public/10.x/artisan.md'))->toLocation()
    )->toBe('/Users/cable8mm/Sites/document2/public/10.x/artisan/index.html');
});
