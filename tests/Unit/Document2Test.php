<?php

use App\Document2;
use Illuminate\Filesystem\Filesystem;

test('get index', function () {
    $document2 = new Document2(
        resolve(Filesystem::class),
        $_ENV['DOC_PATH'],
        $_ENV['DEFAULT_VERSION']
    );

    expect(
        $document2->getIndex('10.x')
    )->toBeString();
});

test('get index array', function () {
    $files = app(Document2::class)->indexArray('10.x');

    expect(
        $files
    )->toBeIterable();
});

it('get page', function () {
    /** @var \App\Documentation $document */
    $document = app(Document2::class);

    expect(
        $document->get('installation', '10.x')
    )->toBeString();
});

test('create Document2 instance', function () {
    $document2 = new Document2(
        new Filesystem(),
        $_ENV['DOC_PATH'],
        $_ENV['DEFAULT_VERSION']
    );

    expect(
        $document2->getIndex('10.x')
    )->toBeString();
});
