<?php

namespace App\Types;

use App\Contracts\Htmlable;
use App\Enums\NavEnum;

class Nav implements Htmlable
{
    /**
     * Nav type
     */
    public function __construct(
        public string $title,
        public NavEnum $section,
        public ?string $link = null,
        public ?string $filename = null
    ) {

    }

    public function toHtml(): string
    {
        $output = '<li>';

        if ($this->link) {
            $output .= '<a href="'.$this->link.'">';
        }

        if ($this->section === NavEnum::Section) {
            $output .= '<h2>'.$this->title.'</h2>';
        }

        if ($this->section === NavEnum::Page) {
            $output .= $this->title;
        }

        if ($this->link) {
            $output .= '</a>';
        }

        $output .= '</li>';

        return $output;
    }

    public function __toString(): string
    {
        return $this->toHtml();
    }
}
