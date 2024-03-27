<?php

use App\Screen\ContentScreen;
use Illuminate\Support\Facades\File;

test('create ContentScreen instance', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'valet.md');

    expect(
        new ContentScreen($contentMd, '10.x')
    )->toBeInstanceOf(ContentScreen::class);
});

test('ContentScreen render', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'testing.md');

    expect(
        (new ContentScreen($contentMd, '10.x'))->render()
    )->toBeString();
});
