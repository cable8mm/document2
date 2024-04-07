<?php

use App\Support\Config;

it('get config without of()', function () {
    expect(Config::get('template'))->toBe('laravel');
});

it('get config all elements', function () {
    expect(Config::all())->toBeArray();
});

it('merge config', function () {
    Config::of([
        'doc_path' => null,
        'template' => null,
        'publish_path' => null,
        'default_version' => null,
        'default_doc' => null,
    ]);

    expect(Config::get('template'))->toBe('laravel');
});
