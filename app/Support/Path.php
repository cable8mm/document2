<?php

namespace App\Support;

use App\Contracts\Pathable;
use App\Types\PathString;

class Path
{
    public static function template(?string $path = null): Pathable
    {
        return new PathString(base_path(
            'templates'.DIRECTORY_SEPARATOR
            .(is_null($path) ? '' : $path.DIRECTORY_SEPARATOR)
            .'index.html'
        ));
    }

    /**
     * Get publish location
     *
     * @param  string  $path  The publish location e.g. `docs`
     * @param  string  $filename  The filename e.g. `artisan.md`
     * @return \App\Contracts\Pathable The method returns the publish location with filename
     */
    public static function publish(?string $path = null, ?string $filename = null): Pathable
    {
        $filename = is_null($filename)
            ? 'index.html'
            : preg_replace('/\.[^\.]+$/', '/index.html', $filename);

        return new PathString(base_path(
            Config::get('publish_path').DIRECTORY_SEPARATOR
            .(is_null($path) ? '' : $path.DIRECTORY_SEPARATOR)
            .$filename
        ));
    }
}
