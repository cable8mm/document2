<?php

namespace App;

use App\Contracts\DriverInterface;

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
     */
    public function save(): void
    {
        /** @var array $pages */
        foreach ($this->documents as $pages) {
            /** @var \App\Page $page */
            foreach ($pages as $page) {
                $page->toFile();
            }
        }
    }
}
