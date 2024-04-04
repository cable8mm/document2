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
        return dirname($this->path);
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
