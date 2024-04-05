<?php

use App\Support\URL;

it('run to', function () {
    expect(URL::to('/10.x/artisan.md'))->toBe('/10.x/artisan');
});
