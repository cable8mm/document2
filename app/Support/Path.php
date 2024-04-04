<?php

namespace App\Support;

use App\Contracts\Pathable;
use App\Types\PathString;

class Path
{
    public static function template(string $path): Pathable
    {
        return new PathString(base_path('templates'.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.'index.html'));
    }

    public static function publish(string $path, string $filename): Pathable
    {
        $filename = preg_replace('/\.[^\.]+$/', '.html', $filename);

        return new PathString(base_path(config('document2.publish_path').DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename));
    }
}
