<?php

use App\Replacers\OriginalUrlReplacer;
use App\Support\Config;

it('change original_url from patterns', function () {
    expect(
        (new OriginalUrlReplacer(Config::get('original_url')))->run('<a href="/api/master">API Documentation</a>')
    )->toBe('<a href="'.Config::get('original_url').'/api/master">API Documentation</a>');
});

it('change original_url from patterns with single quotation', function () {
    expect(
        (new OriginalUrlReplacer(Config::get('original_url')))->run('<a href=\'/api/master\'>API Documentation</a>')
    )->toBe('<a href=\''.Config::get('original_url').'/api/master\'>API Documentation</a>');
});

it('change original_url from patterns with long html', function () {
    expect(
        (new OriginalUrlReplacer(Config::get('original_url')))->run('<li><a href="/api/master">API Documentation</a></li>')
    )->toBe('<li><a href="'.Config::get('original_url').'/api/master">API Documentation</a></li>');
});

it('dont change original_url from patterns with long html', function () {
    $versions = Config::get('versions');

    foreach ($versions as $version) {
        expect(
            (new OriginalUrlReplacer(Config::get('original_url')))->run('<li><a href="/'.$version.'/valet">Valet</a></li>')
        )->toBe('<li><a href="/'.$version.'/valet">Valet</a></li>');
    }
});
