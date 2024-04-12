<?php

namespace App;

use App\Contracts\DriverInterface;
use App\Contracts\Htmlable;
use App\Contracts\Markdownable;
use App\Contracts\RendererInterface;
use App\Replacers\AppUrlReplacer;
use App\Replacers\CanonicalReplacer;
use App\Replacers\ContentReplacer;
use App\Replacers\DocsLinkReplacer;
use App\Replacers\NavigationReplacer;
use App\Replacers\OriginalUrlReplacer;
use App\Replacers\SectionTitleReplacer;
use App\Replacers\TitleReplacer;
use App\Replacers\VersionOptionsReplacer;
use App\Replacers\VersionReplacer;
use App\Support\Config;
use App\Support\Path;
use App\Support\URL;
use App\Types\HtmlString;
use App\Types\NavCollection;
use App\Types\VersionCollection;
use Illuminate\Support\Facades\File;
use Stringable;

class Page implements Htmlable, Stringable
{
    public string $title;

    public string $sectionTitle;

    public array $versions;

    public string $canonical;

    /**
     * @var \App\Types\NavCollection Documentation navigation collection
     */
    protected NavCollection $navCollection;

    /**
     * @var \App\Contracts\Markdownable Documentation file content
     */
    protected Markdownable $content;

    public function __construct(
        protected string $filename,
        protected string $version,
        protected ?DriverInterface $driver = null
    ) {
        $this->navCollection = $this->driver::getNavs($version, $filename);

        [$this->title, $this->content] = $this->driver::getDocument($version, $filename);

        $this->versions = $this->driver::getVersions();
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function title(): string
    {
        return strip_tags($this->title);
    }

    public function getSectionTitle(): string
    {
        return strip_tags($this->navCollection->getSectionTitle($this->title));
    }

    public function navigation(): Htmlable|RendererInterface
    {
        return $this->driver::getNavHtml($this->navCollection);
    }

    public function version(): string
    {
        return $this->version;
    }

    public function toHtml(): string
    {
        $location = $this->driver->getTemplateLocation();

        $template = new HtmlString(File::get($location));

        return $template->register([
            new NavigationReplacer(
                $this->navigation()->register([
                    new DocsLinkReplacer('/'.$this->version.'/'),
                    new OriginalUrlReplacer(Config::get('original_url')),
                ])->render()
            ),
            new ContentReplacer(
                $this->content->toHtmlable()->register([
                    new DocsLinkReplacer('/'.$this->version.'/'),
                    new OriginalUrlReplacer(Config::get('original_url')),
                ])->render()
            ),
            new TitleReplacer($this->title()),
            new SectionTitleReplacer($this->getSectionTitle()),
            new CanonicalReplacer(URL::canonical($this->filename, $this->version)),
            new AppUrlReplacer(Config::get('app_url')),
            new VersionReplacer($this->version),
            new VersionOptionsReplacer(
                (new VersionCollection(
                    Config::get('versions'),
                    $this->version
                ))->toOptions($this->filename)
            ),
        ])->render();
    }

    /**
     * Save the document to the filesystem
     *
     * @return string|bool The methods return the location written to the filesystem or false on failure
     */
    public function toFile(): string|bool
    {
        $location = Path::publish($this->version, $this->filename);

        File::ensureDirectoryExists($location->toDir());

        return is_bool(File::put($location->toLocation(), $this->toHtml())) ? false : $location;
    }

    /**
     * Save the document to the filesystem for front page
     *
     * @return string|bool The methods return the location written to the filesystem or false on failure
     */
    public function toFrontFile(): string|bool
    {
        $location = Path::publish($this->version);

        File::ensureDirectoryExists($location->toDir());

        return is_bool(File::put($location->toLocation(), $this->toHtml())) ? false : $location;
    }

    public function __toString()
    {
        return $this->toHtml();
    }

    /**
     * Get page to match from filename
     *
     * @param  array  $pages  Array of pages
     * @param  string  $filename  The filename
     * @return \App\Page|null The method returns \App\Page on success or null if no matching page
     */
    public static function getFromFilename(array $pages, string $filename): ?\App\Page
    {
        foreach ($pages as $page) {
            if ($page->filename() === $filename) {
                return $page;
            }
        }
    }
}
