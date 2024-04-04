<?php

use App\Drivers\Driver;

it('run glob method', function () {
    expect(
        Driver::glob('10.x')
    )->toBeArray();
});

it('run excludes method', function () {
    expect(
        Driver::excludes()
    )->toBeArray();
});

it('run getDefaultVersion method', function () {
    expect(
        Driver::getDefaultVersion()
    )->toBe('20.x');
});

it('run getDocumentRoot method', function () {
    expect(
        (string) Driver::getDocumentRoot()
    )->toBe(base_path().DIRECTORY_SEPARATOR.config('document2.doc_path'));
});

it('run getVersions method', function () {
    expect(
        Driver::getVersions()
    )->toBeArray();
});
