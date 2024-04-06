<?php

use App\Document2;

it('create instance', function () {
    expect(
        new Document2()
    )->toBeInstanceOf(Document2::class);
});

it('save', function () {
    (new Document2())->save();

    expect(
        glob(public_path().'*')
    )->toBeArray();
});

it('should run count method', function () {
    expect(
        (new Document2())->count()
    )->toBe(11);
});

test('combine config', function () {
    $config = [
        'template' => 'cable8mm',
    ];

    $config = [...config('document2'), ...$config];

    expect($config['template'])->toBe('cable8mm');
});
