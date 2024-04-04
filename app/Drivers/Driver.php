<?php

namespace App\Drivers;

use App\Contracts\DriverInterface;
use App\Contracts\Htmlable;
use App\Contracts\Pathable;
use App\Types\NavCollection;
use App\Types\PathString;

abstract class Driver implements DriverInterface
{
    abstract public static function getNavs(?string $path = null): \App\Types\NavCollection;

    abstract public static function getNavFile(): string;

    abstract public static function getNavHtml(NavCollection $navCollection): Htmlable;

    abstract public static function getDocument(string $path, string $filename): array;

    /**
     * {@inheritDoc}
     */
    public static function getDocumentRoot(?string $path = null): Pathable
    {
        $path = base_path(
            $path
            ? config('document2.doc_path').DIRECTORY_SEPARATOR.$path
            : config('document2.doc_path')
        );

        return new PathString($path);
    }

    /**
     * {@inheritDoc}
     */
    public static function excludes(): array
    {
        return config('document2.excludes');
    }

    /**
     * {@inheritDoc}
     */
    public static function getVersions(): ?array
    {
        return config('document2.versions');
    }

    /**
     * {@inheritDoc}
     */
    public static function getDefaultVersion(): ?string
    {
        return config('document2.default_version');
    }

    /**
     * {@inheritDoc}
     */
    public static function glob(string $path): array
    {
        return collect(glob(self::getDocumentRoot($path.DIRECTORY_SEPARATOR.'*')))
            ->filter(function ($item) {
                foreach (self::excludes() as $exclude) {
                    if (strpos($item, $exclude) !== false) {
                        return false;
                    }
                }

                return true;
            })
            ->map(function ($item) {
                return basename($item);
            })
            ->toArray();
    }
}
