<?php

namespace App;

use App\Screen\ContentScreen;
use App\Screen\NavigationScreen;
use Symfony\Component\DomCrawler\Crawler;

class Page
{
    public NavigationScreen $navigationScreen;

    public ContentScreen $contentScreen;

    public string $title;

    public array $versions;

    public string $canonical;

    public function __construct(
        protected string $filename,
        protected string $navigationMd,
        protected string $contentMd,
        protected string $version
    ) {
        $this->contentScreen = new ContentScreen($contentMd, $version);

        $this->navigationScreen = new NavigationScreen($navigationMd);

        $this->title = (new Crawler($this->contentScreen->render()))->filterXPath('//h1')->text();

        $this->versions = Document2::getDocVersions();
    }

    public function filename(): string
    {
        return $this->filename;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function navigation(): string
    {
        return $this->navigationScreen->render();
    }

    public function content(): string
    {
        return $this->contentScreen->render();
    }

    public function version(): string
    {
        return $this->version;
    }
}
