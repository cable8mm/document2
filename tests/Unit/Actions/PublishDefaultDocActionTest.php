<?php

use App\Actions\PublishDefaultDocAction;

test('PublishDefaultVersionAction run', function () {
    $publishDefaultDocAction = new PublishDefaultDocAction(
        '10.x',
        'artisan.md'
    );

    expect(
        $publishDefaultDocAction->execute()
    )->not->toBe(false);
});
