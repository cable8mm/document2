<?php

use App\Page;
use Illuminate\Support\Facades\File;

test('Page can render csrf page', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'testing.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'csrf',
        $navigationMd,
        $contentMd,
        '20.x'
    );

    expect(
        $page->navigation()
    )->toContain('csrf');
});

test('Page can render valet page', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'valet.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'valet',
        $navigationMd,
        $contentMd,
        '20.x'
    );

    expect(
        $page->content()
    )->toContain('Valet');
});

test('Page can get filename', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'testing.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'eloquent',
        $navigationMd,
        $contentMd,
        '20.x'
    );

    expect(
        $page->filename()
    )->toContain('eloquent');
});

test('Page can get title', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'valet.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'valet',
        $navigationMd,
        $contentMd,
        '20.x'
    );

    expect(
        $page->title()
    )->toContain('Valet');
});

test('Page can get version', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'valet.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'deployment',
        $navigationMd,
        $contentMd,
        '20.x'
    );

    expect(
        $page->version()
    )->toBe('20.x');
});
