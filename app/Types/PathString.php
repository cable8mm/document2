<?php

namespace App\Types;

use App\Contracts\Pathable;
use Stringable;

class PathString implements Pathable, Stringable
{
    /**
     * Create a new Path string instance.
     *
     * @param  string  $path  The Path string.
     * @return void
     */
    public function __construct(
        protected string $path = '')
    {

    }

    /**
     * Get the Path string.
     */
    public function toPath(): string
    {
        return $this->path;
    }

    /**
     * Get the parent path string or the directory from location.
     */
    public function toDir(): string
    {
        $url = preg_replace('/\/index\.html$/', '', $this->path);

        return preg_replace('/\.[^\.\/x]+$/', '', $url);
    }

    /**
     * Get published location.
     */
    public function toLocation(): string
    {
        return $this->toDir().DIRECTORY_SEPARATOR.'index.html';
    }

    /**
     * Determine if the given Path string is empty.
     */
    public function isEmpty(): bool
    {
        return $this->path === '';
    }

    /**
     * Determine if the given Path string is not empty.
     */
    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }

    /**
     * Get the Path string.
     */
    public function __toString(): string
    {
        return $this->toPath();
    }
}
