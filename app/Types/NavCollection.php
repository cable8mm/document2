<?php

namespace App\Types;

use App\Enums\NavEnum;

class NavCollection
{
    protected array $sections = [];

    /**
     * Constructor
     *
     * @param  \App\Types\Nav[]  $navs  The array of navigation
     */
    public function __construct(
        public array $navs
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

    public function toArray(): array
    {
        return $this->sections;
    }
}
