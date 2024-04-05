<?php

namespace App;

use App\Contracts\DriverInterface;
use Generator;

class Document2
{
    /**
     * @var array<version:Page[]> The list of pages of the specific version
     */
    protected array $documents;

    /**
     * Create a new documentation instance.
     *
     * @param  \App\Contracts\DriverInterface  $driver  The driver
     * @return void
     */
    public function __construct(
        protected DriverInterface $driver
    ) {
        foreach ($this->driver::getVersions() as $version) {

            $pages = [];

            foreach ($this->driver::glob($version) as $filename) {
                $pages[] = new Page($filename, $version, $this->driver);
            }

            $this->documents[] = $pages;
        }
    }

    /**
     * Save all documents
     *
     * @example foreach ((new Document2( new LaravelDriver ))->save() as $filename) { messaging(); }
     */
    public function save(): Generator
    {
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
