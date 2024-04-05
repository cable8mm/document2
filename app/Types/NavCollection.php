<?php

namespace App\Types;

use App\Enums\NavEnum;

/**
 * Navigation data structure
 */
class NavCollection
{
    /**
     * @var <int, \App\Types\Nav[]> The navigation items
     */
    protected array $sections = [];

    /**
     * Constructor
     *
     * @param  \App\Types\Nav[]  $navs  The array of navigation
     * @param  string  $filename  The name of the file e.g. `artisan.md`
     */
    public function __construct(
        public array $navs,
        public string $filename
    ) {
        $sectionKey = -1;

        foreach ($navs as $key => $nav) {
            if ($nav->section === NavEnum::Section) {
                $sectionKey++;
                $this->sections[$sectionKey]['section'] = $nav;
            }

            if ($nav->section === NavEnum::Page) {
                $this->sections[$sectionKey]['pages'][] = $nav;
            }
        }
    }

    /**
     * Output the navigation data
     *
     * @return array The method returns the navigation data
     */
    public function toArray(): array
    {
        return $this->sections;
    }
}
