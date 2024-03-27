<?php

use App\Actions\PublishDocAction;
use App\Page;
use Illuminate\Support\Facades\File;

test('PublishDocAction run', function () {
    $contentMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'urls.md');
    $navigationMd = File::get(getcwd().DIRECTORY_SEPARATOR.$_ENV['DOC_PATH'].DIRECTORY_SEPARATOR.'10.x'.DIRECTORY_SEPARATOR.'documentation.md');

    $page = new Page(
        'urls',
        $navigationMd,
        $contentMd,
        '10.x'
    );

    expect(
        (new PublishDocAction(
            getcwd().'/templates/laravel/index.html',
            getcwd().DIRECTORY_SEPARATOR.$_ENV['PUBLISH_PATH']
        ))->addPage($page)->execute()
    )->not->toBe(false);
});
