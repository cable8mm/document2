<?php

use App\Drivers\LaravelDriver;
use App\Page;

it('should generate a static html', function () {
    $page = new Page(
        'artisan.md',
        '10.x',
        new LaravelDriver()
    );

    expect(
        $page->toFile()
    )->toBeString();
});
