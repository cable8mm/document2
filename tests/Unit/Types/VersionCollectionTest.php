<?php

use App\Types\VersionCollection;

it('run toPath', function () {
    $versionCollection = new VersionCollection(['10.x' => '10.x', '20.x' => '20.x'], '10.x');

    expect(
        $versionCollection->toOptions('artisan.md')
    )->toBeString();
});
