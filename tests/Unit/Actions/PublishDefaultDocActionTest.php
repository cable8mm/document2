<?php

use App\Actions\PublishDefaultDocAction;

test('PublishDefaultVersionAction run', function () {
    $publishDefaultDocAction = new PublishDefaultDocAction(
        getcwd().DIRECTORY_SEPARATOR.$_ENV['PUBLISH_PATH'],
        '10.x',
        'installation'
    );

    expect(
        $publishDefaultDocAction->execute()
    )->not->toBe(false);
});
