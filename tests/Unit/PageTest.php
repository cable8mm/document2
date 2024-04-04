<?php

use App\Contracts\Htmlable;
use App\Drivers\LaravelDriver;
use App\Page;

it('creates a new instance', function () {
    $page = new Page('artisan.md', '10.x', new LaravelDriver());

    expect($page)->toBeInstanceOf(Page::class);
});

it('run filename', function () {
    $page = new Page('artisan.md', '10.x', new LaravelDriver());

    expect($page->filename())->toBe('artisan.md');
});

it('run title', function () {
    $page = new Page('artisan.md', '10.x', new LaravelDriver());

    expect($page->title())->toBe('Artisan Console');
});

it('run navigation', function () {
    $page = new Page('artisan.md', '10.x', new LaravelDriver());

    expect($page->navigation())->toBeInstanceOf(Htmlable::class);
});

it('run version', function () {
    $page = new Page('artisan.md', '10.x', new LaravelDriver());

    expect($page->version())->toBe('10.x');
});

it('run toHtml', function () {
    $page = new Page('artisan.md', '10.x', new LaravelDriver());

    expect($page->toHtml())->toBeString()->dump();
});

it('run toFile', function () {
    $page = new Page('artisan.md', '10.x', new LaravelDriver());

    expect($page->toFile())->toBeInt()->dump();
});
