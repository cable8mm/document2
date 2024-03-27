<?php

it('get config', function () {
    expect(config('document2.doc_path'))->toBe('docs');
});
