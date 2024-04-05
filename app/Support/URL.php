<?php

namespace App\Support;

class URL
{
    /**
     * Get the URL from the published
     *
     * @param  string  $published  local path to publish
     * @return string The method returns the URL
     *
     * @example URL::to('/10.x/artisan.md') => /10.x/artisan/index.html
     */
    public static function to(string $published): string
    {
        return preg_replace('/\.[^\/]+$/', '/index.html', $published);
    }
}
