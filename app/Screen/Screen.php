<?php

namespace App\Screen;

use App\Contracts\ScreenInterface;
use App\Support\Renderer;

class Screen implements ScreenInterface
{
    /**
     * @var string The html from the specified markdown file
     */
    protected string $screen;

    /**
     * @var \App\Renderer The renderer instance for ScreenInterface
     */
    protected Renderer $renderer;

    /**
     * @var string The string after rendering
     */
    protected string $renderString = '';

    public function __construct()
    {
        $this->renderer = new Renderer();
    }

    /**
     * Render the html from the specified markdown file
     *
     * @return string Returns the rendered html
     */
    public function render(): string
    {
        return $this->renderer->html($this->screen)->render();

        // return empty($this->renderString)
        //     ? $this->renderString = $this->renderer->html($this->screen)->render()
        //     : $this->renderString;
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
