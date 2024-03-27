<?php

use App\Actions\PublishAction;
use App\Page;
use Illuminate\Support\Facades\File;

test('PublishAction run', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'first-page.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        (new PublishAction(
            getcwd().'/templates/laravel/index.html',
            getcwd().DIRECTORY_SEPARATOR.$_ENV['PUBLISH_PATH']
        ))->addPage($page)->execute()
    )->not->toBe(false);
});
