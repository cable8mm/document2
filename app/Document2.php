<?php

namespace App;

use App\Contracts\DriverInterface;
use App\Support\Config;
use App\Support\Reflection;
use Generator;
use InvalidArgumentException;

class Document2
{
    /**
     * @var array<version,Page[]> The list of pages of the specific version
     */
    protected array $documents;

    protected DriverInterface $driver;

    /**
     * Create a new documentation instance.
     *
     * @param  \App\Contracts\DriverInterface  $driver  The driver
     * @return void
     */
    public function __construct(
        array $config = []
    ) {
        Config::of($config);

        $this->driver = Reflection::driver(Config::get('template'));

        foreach ($this->driver::getVersions() as $version) {

            $pages = [];

            foreach ($this->driver::glob($version) as $filename) {
                $pages[] = new Page($filename, $version, $this->driver);
            }

            $this->documents[$version] = $pages;
        }
    }

    /**
     * Save all documents
     *
     * @param  string|null  $version  The version e.g. '10.x' or 'master'
     * @param  string|null  $filename  The name of the file e.g. 'artisan.md'
     * @return \Generator PHP Generator
     *
     * @throws \InvalidArgumentException
     *
     * @example foreach ((new Document2( new LaravelDriver ))->save() as $filename) { messaging(); }
     */
    public function save(?string $version = null, ?string $filename = null): \Generator
    {
        assert(
            (is_null($version) && is_null($filename)) || (! is_null($version)), new InvalidArgumentException('The version parameter is required')
        );

        if (! is_null($version) && ! is_null($filename)) {
            yield Page::getFromFilename($this->documents[$version], $filename)->toFile();

            return;
        }

        if (! is_null($version)) {
            foreach ($this->documents[$version] as $page) {
                yield $page->toFile();
            }

            return;
        }

        /** @var array $pages */
        foreach ($this->documents as $pages) {
            /** @var \App\Page $page */
            foreach ($pages as $page) {
                yield $page->toFile();
            }
        }
    }

    /**
     * Get the count of all pages
     *
     * @return int count of all pages
     */
    public function count(): int
    {
        return count($this->documents, 1) - count($this->documents, 0);
    }
}
