<?php

namespace App;

use App\Contracts\DriverInterface;
use App\Contracts\Htmlable;
use App\Contracts\Markdownable;
use App\Replacers\ContentReplacer;
use App\Replacers\NavigationReplacer;
use App\Replacers\VersionReplacer;
use App\Screen\ContentScreen;
use App\Screen\NavigationScreen;
use App\Support\Path;
use App\Types\HtmlString;
use App\Types\NavCollection;
use Illuminate\Support\Facades\File;
use Stringable;

class Page implements Htmlable, Stringable
{
    public NavigationScreen $navigationScreen;

    public ContentScreen $contentScreen;

    public string $title;

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
        $this->navCollection = $this->driver::getNavs($version);

        [$this->title, $this->content] = $this->driver::getDocument($version, $filename);

        $this->versions = $this->driver::getVersions();
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function navigation(): Htmlable
    {
        return $this->driver::getNavHtml($this->navCollection);
    }

    public function version(): string
    {
        return $this->version;
    }

    public function toHtml(): string
    {
        $html = $this->content->toHtml();

        $location = Path::template(
            config('document2.template')
        );

        $template = new HtmlString(File::get($location));

        return $template->register([
            new NavigationReplacer((string) $this->navigation()),
            new VersionReplacer($this->version),
            new ContentReplacer($html),
        ])->render();
    }

    /**
     * Save the document to the filesystem
     *
     * @return int|bool The methods return the number of bytes written to the filesystem or false on failure
     */
    public function toFile(): int|bool
    {
        $location = Path::publish($this->version, $this->filename);

        File::ensureDirectoryExists($location->toDir());

        return File::put($location, $this->toHtml());
    }

    public function __toString()
    {
        return $this->toHtml();
    }
}
