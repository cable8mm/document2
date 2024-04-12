<?php

namespace App\Support;

use App\Contracts\Pathable;
use App\Types\PathString;
use Illuminate\Support\Facades\File;

class Path
{
    /**
     * Get the template location from the given path
     *
     * @param  string|null  $path  The path to get the template location from or null to use the default location
     * @return \App\Contracts\Pathable The template location
     */
    public static function template(?string $path = null): Pathable
    {
        $srcPath = base_path(
            Config::get('template_path').DIRECTORY_SEPARATOR
            .(is_null($path) ? '' : $path.DIRECTORY_SEPARATOR)
            .Config::get('template').DIRECTORY_SEPARATOR
            .'dist'.DIRECTORY_SEPARATOR.'index.html'
        );

        if (File::exists($srcPath)) {
            return new PathString($srcPath);
        } else {
            return new PathString(base_path(
                Config::get('template_path').DIRECTORY_SEPARATOR
                .Config::get('template').DIRECTORY_SEPARATOR
                .(is_null($path) ? '' : $path.DIRECTORY_SEPARATOR)
                .'index.html'
            ));
        }
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
