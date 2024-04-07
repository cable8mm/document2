<?php

namespace App\Types;

use App\Contracts\Htmlable;
use App\Contracts\Markdownable;
use App\Markdown\GithubFlavoredMarkdownConverter;
use Stringable;

class MarkdownString implements Markdownable, Stringable
{
    /**
     * Create a new Markdown string instance.
     *
     * @param  string  $markdown  The Markdown string.
     * @return void
     */
    public function __construct(
        protected string $markdown = '')
    {

    }

    /**
     * Get the Markdown string.
     */
    public function toMarkdown(): string
    {
        return $this->markdown;
    }

    public function toHtml(): string
    {
        return (new GithubFlavoredMarkdownConverter())->convert($this->toMarkdown());
    }

    public function toHtmlable(): Htmlable
    {
        return new HtmlString((new GithubFlavoredMarkdownConverter())->convert($this->toMarkdown()));
    }

    /**
     * Determine if the given Markdown string is empty.
     */
    public function isEmpty(): bool
    {
        return $this->markdown === '';
    }

    /**
     * Determine if the given Markdown string is not empty.
     */
    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }

    /**
     * Get the Markdown string.
     */
    public function __toString(): string
    {
        return $this->toMarkdown();
    }
}
