<?php

use App\Document2;
use App\Drivers\LaravelDriver;

it('create instance', function () {
    $driver = new LaravelDriver();

    expect(
        new Document2($driver)
    )->toBeInstanceOf(Document2::class);
});

it('save', function () {
    $driver = new LaravelDriver();

    (new Document2($driver))->save();

    expect(
        glob(public_path().'*')
    )->toBeArray();
});

it('should run count method', function () {
    expect(
        (new Document2(
            new LaravelDriver
        ))->count()
    )->toBe(11)->dump();
});
