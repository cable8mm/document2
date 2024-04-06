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
     * @example URL::to('/10.x/artisan.md') => /10.x/artisan
     */
    public static function to(string $published): string
    {
        return preg_replace('/\.[^\/]+$/', '', $published);
    }

    public static function filenameFromNav(string $path): string
    {
        return preg_replace('/^.+\/([^\/]+)$/', '\\1', $path).'.md';
    }

    /**
     * Get the path from the filename
     *
     * @param  string  $filename  filename e.g. `artisan.md`
     * @return string The method returns the path from the filename
     *
     * @example URL::filename2path('artisan.md') => `artisan`
     */
    public static function filename2path(string $filename): string
    {
        return preg_replace('/\.[^\/\.]+$/', '', $filename);
    }

    /**
     * Get the location with domain and path
     *
     * @param  string  $filename  The filename e.q. `artisan.md`
     * @param  string|null  $version  The version e.q. `master` or `10.x`
     * @return string The method returns the location with domain and path
     */
    public static function canonical(string $filename, ?string $version = null): string
    {
        return Config::get('current_domain')
            .(is_null($version) ? '' : '/'.$version)
            .'/'.self::filename2path($filename);
    }
}
