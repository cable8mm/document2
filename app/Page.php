<?php

namespace App;

use App\Markdown\GithubFlavoredMarkdownConverter;
use App\Replacers\ContentReplacer;
use App\Replacers\NavigationReplacer;
use App\Replacers\VersionReplacer;
use Symfony\Component\DomCrawler\Crawler;

class Page
{
    public string $title;

    public string $content;

    public array $versions;

    public string $navigation;

    public string $canonical;

    private string $html;

    private Renderer $renderer;

    public function __construct(
        private string $md,
        private string $version,
        private string $navigationMd,
        private string $htmlPath
    ) {
        assert(! empty($navigationMd));
        $this->navigation = (new GithubFlavoredMarkdownConverter())->convert($navigationMd);

        assert(! empty($md));
        $this->content = (new GithubFlavoredMarkdownConverter())->convert($md);

        $this->title = (new Crawler($this->content))->filterXPath('//h1')->text();

        $this->versions = Document2::getDocVersions();

        $this->renderer = (new Renderer())->register([
            new NavigationReplacer($this->navigation),
            new ContentReplacer($this->content),
            new VersionReplacer($this->version),
        ]);
    }

    public function render()
    {
        return $this->renderer->html($this->content)->render();
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param  string  $version
     * @param  string  $content
     * @return string
     */
    public static function replaceLinks($version, $content)
    {
        return str_replace('%7B%7Bversion%7D%7D', $version, $content);
    }
}
