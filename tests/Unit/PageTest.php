<?php

use App\Page;
use Illuminate\Support\Facades\File;

test('Page can render first page', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'first-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->navigation()
    )->toContain('First Page');
});

test('Page can render second page', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'second-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->content()
    )->toContain('Second Page');
});

test('Page can get filename', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'second-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->filename()
    )->toContain('second-page');
});

test('Page can get title', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'second-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->title()
    )->toContain('Second Page');
});

test('Page can get version', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'second-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        $page->version()
    )->toBe('10.x');
});
