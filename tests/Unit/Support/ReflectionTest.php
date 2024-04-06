<?php

use App\Contracts\DriverInterface;
use App\Drivers\Driver;
use App\Support\Reflection;

it('run driver', function () {
    expect(Reflection::driver('laravel'))->toBeInstanceOf(DriverInterface::class);
});

test('how to get ::class', function () {
    expect(Driver::class)->toBe('App\Drivers\Driver');
});
