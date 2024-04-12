<?php

namespace App\Contracts;

interface Pathable
{
    /**
     * Get the relative location from the absolute location
     *
     * @return string The relative location from the absolute location
     *
     * @example (new PathString('/Users/cable8mm/Sites/document2/public/10.x/artisan.md'))->toPath() /public/10.x/artisan.md
     */
    public function toPath(): string;

    /**
     * Get the directory from the location
     *
     * @return string The directory
     *
     * @example (new PathString('/Users/cable8mm/Sites/document2/public/10.x/artisan.md'))->toPath() /Users/cable8mm/Sites/document2/public/10.x/artisan
     * @example (new PathString('/Users/cable8mm/Sites/document2/public/10.x'))->toDir() /Users/cable8mm/Sites/document2/public/10.x
     */
    public function toDir(): string;

    /**
     * Get the published location to the folder
     *
     * @return string The location to the folder
     *
     * @example (new PathString('/Users/cable8mm/Sites/document2/public/10.x/artisan.md'))->toLocation() /Users/cable8mm/Sites/document2/public/10.x/artisan/index.html
     * @example (new PathString('/Users/cable8mm/Sites/document2/public/10.x/artisan/index.html'))->toLocation() /Users/cable8mm/Sites/document2/public/10.x/artisan/index.html
     */
    public function toLocation(): string;
}
