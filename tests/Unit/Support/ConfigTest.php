<?php

use App\Support\Config;

it('get config without of()', function () {
    expect(Config::get('template'))->toBe('laravel');
});
