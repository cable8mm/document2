<?php

it('get config', function () {
    expect(config('document2.doc_path'))->toBe('tests/Fixtures/docs');
});

it('get config from app', function () {
    expect(app()['config']['torchlight']['host'])->toBe('https://api.torchlight.dev');
});
