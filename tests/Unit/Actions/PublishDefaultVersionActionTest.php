<?php

use App\Actions\PublishDefaultVersionAction;

test('PublishDefaultVersionAction run', function () {
    $publishDefaultVersionAction = new PublishDefaultVersionAction(
        getcwd().DIRECTORY_SEPARATOR.$_ENV['PUBLISH_PATH'],
        '10.x'
    );

    expect(
        $publishDefaultVersionAction->execute()
    )->not->toBe(false);
});

test('PublishDefaultVersionAction run in public folder', function () {
    $publishDefaultVersionAction = new PublishDefaultVersionAction(
        '10.x'
    );

    expect(
        $publishDefaultVersionAction->execute()
    )->not->toBe(false);
});
