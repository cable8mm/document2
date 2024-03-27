<?php

use App\Page;
use Illuminate\Support\Facades\File;

test('PageTest can render first page', function () {
    $md = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'first-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $md,
        '10.x',
        $navigationMd,
        $_ENV['PUBLISH_PATH']
    );

    expect(
        $page->render()
    )->toContain('First Page');
});

test('PageTest can render second page', function () {
    $md = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'second-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $md,
        '10.x',
        $navigationMd,
        $_ENV['PUBLISH_PATH']
    );

    expect(
        $page->render()
    )->toContain('Second Page');
});
