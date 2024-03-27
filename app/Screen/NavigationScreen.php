<?php

namespace App\Screen;

use App\Markdown\GithubFlavoredMarkdownConverter;

class NavigationScreen extends Screen
{
    public string $screen;

    public string $canonical;

    /**
     * Constructor
     *
     * @param  string  $md  The markdown for navigation screen. e.g. documentation.md
     */
    public function __construct(
        string $md
    ) {
        parent::__construct();

        assert(! empty($md));
        $this->screen = (new GithubFlavoredMarkdownConverter())->convert($md);
    }
}
