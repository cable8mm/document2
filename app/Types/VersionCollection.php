<?php

namespace App\Types;

use App\Support\URL;

class VersionCollection
{
    /**
     * Nav type
     */
    public function __construct(
        public array $versions,
        public string $currentVersion
    ) {

    }

    /**
     * Get the options html
     *
     * @param  string  $filename  markdown filename
     * @return string The method returns the options html
     */
    public function toOptions(string $filename): string
    {
        $html = '';

        foreach ($this->versions as $version) {
            $html .= '<option value="'.URL::to('/'.$version.'/'.$filename).'"'
            .($this->currentVersion == $version ? ' selected' : '')
            .'>'.$version.'</option>'.PHP_EOL;
        }

        return $html;
    }
}
