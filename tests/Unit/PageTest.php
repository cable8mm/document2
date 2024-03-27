<?php

use App\Page;
use Illuminate\Support\Facades\File;

test('Page can render csrf page', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'csrf.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'csrf',
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->navigation()
    )->toContain('csrf');
});

test('Page can render dusk page', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'dusk.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'dusk',
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->content()
    )->toContain('Dusk');
});

test('Page can get filename', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'eloquent.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'eloquent',
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->filename()
    )->toContain('eloquent');
});

test('Page can get title', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'blade.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'blade',
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->title()
    )->toContain('Blade');
});

test('Page can get version', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'deployment.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'deployment',
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->version()
    )->toBe('10.x');
});
