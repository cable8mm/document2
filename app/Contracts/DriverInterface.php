<?php

namespace App\Contracts;

use App\Types\NavCollection;

interface DriverInterface
{
    /**
     * Get navigation array
     *
     * @param  string  $path  The version e.g. `10.x`
     * @param  string  $filename  The filename e.g. `artisan.md`
     * @return : \App\Types\NavCollection The navigation collection
     */
    public static function getNavs(string $path, string $filename): \App\Types\NavCollection;

    /**
     * Get the excluded paths
     *
     * @return string[] The paths to exclude
     */
    public static function excludes(): array;

    /**
     * Get the all versions of the documents
     *
     * @return null|array<string,string> The <string,string> versions of the documents. e.g. ['10.x'=>'10.x', 'master'=>'Master',...]
     */
    public static function getVersions(): ?array;

    /**
     * Get the default version
     *
     * @return ?string The default version, e.g. '10.x'
     */
    public static function getDefaultVersion(): ?string;

    /**
     * Get the navigation markdown filename
     *
     * @return string The navigation markdown filename. e.g. 'documentation.md'
     */
    public static function getNavFile(): string;

    /**
     * Get the documentation root folder
     *
     * @param  string|null  $path  The path to the documentation for specific version. e.g. '10.x'
     * @return string The methods returns the documentation root folder
     */
    public static function getDocumentRoot(?string $path = null): Pathable;

    /**
     * Get the documentation
     *
     * @param  string  $path  The path to the documentation for specific version. e.g. '10.x'
     * @param  string  $filename  The filename
     * @return array{'title':string,'markdown':\App\Contracts\Markdownable} The methods returns the documentation root folder
     */
    public static function getDocument(string $path, string $filename): array;

    /**
     * Get the Navigation to HTML
     *
     * @param  \App\Types\NavCollection  $navCollection  The navigation collection
     * @return \App\Contracts\Htmlable The methods returns the navigation to HTML
     */
    public static function getNavHtml(NavCollection $navCollection): Htmlable;

    /**
     * Get the documentations for the specific version
     *
     * @param  string  $path  The version, e.g. '10.x'
     * @return string[] The documentation filenames for the specific version
     */
    public static function glob(string $path): array;

    /**
     * Get the path to the template file
     *
     * @return Pathable The method returns the path to the template
     */
    public static function getTemplatePath(): Pathable;

    /**
     * Get the location to the template file
     *
     * @return Pathable The method returns the location to the template
     */
    public static function getTemplateLocation(): Pathable;
}
