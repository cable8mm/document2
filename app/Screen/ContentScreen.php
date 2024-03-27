<?php

namespace App\Screen;

use App\Document2;
use App\Markdown\GithubFlavoredMarkdownConverter;
use App\Replacers\VersionReplacer;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class ContentScreen extends Screen
{
    public string $screen;

    public array $versions;

    public string $canonical;

    /**
     * Constructor
     *
     * @param  string  $md  The markdown for content file. e.g. installation.md, usage.md, etc
     * @param  string  $version  The documentation version. This same as github branch name. e.g. 10.x
     */
    public function __construct(
        string $md,
        private string $version
    ) {
        parent::__construct();

        assert(! empty($md));
        $this->screen = (new GithubFlavoredMarkdownConverter())->convert($md);

        $this->versions = Document2::getDocVersions();

        $this->renderer = $this->renderer->register([
            new VersionReplacer($this->version),
        ]);
    }

    public function title(): string
    {
        return (new Crawler($this->render()))->filterXPath('//h1')->text();
    }

    public function filename()
    {
        return Str::of($this->title())->kebab();
    }
}
