<?php

use App\Screen\NavigationScreen;
use Illuminate\Support\Facades\File;

test('create NavigationScreen instance', function () {
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'documentation.md');

    expect(
        new NavigationScreen($navigationMd)
    )->toBeInstanceOf(NavigationScreen::class);
});

test('NavigationScreen render', function () {
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'20.x'.DIRECTORY_SEPARATOR.'documentation.md');

    expect(
        (new NavigationScreen($navigationMd))->render()
    )->toBeString();
});
