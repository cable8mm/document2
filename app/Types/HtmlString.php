<?php

namespace App\Types;

use App\Contracts\Htmlable;
use App\Contracts\ReplacerInterface;
use Stringable;

/**
 * Html String
 *
 * @example (new HtmlString($html))->register([new NavigationReplacer('navigation string')])->render()
 */
class HtmlString implements Htmlable, Stringable
{
    private array $replacers = [];

    /**
     * Create a new HTML string instance.
     *
     * @param  string  $html  The HTML string.
     * @return void
     */
    public function __construct(
        protected string $html = '')
    {

    }

    /**
     * Get the HTML string.
     */
    public function toHtml(): string
    {
        return $this->html;
    }

    /**
     * Determine if the given HTML string is empty.
     */
    public function isEmpty(): bool
    {
        return $this->html === '';
    }

    /**
     * Determine if the given HTML string is not empty.
     */
    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }

    /**
     * Get the HTML string.
     */
    public function __toString(): string
    {
        return $this->toHtml();
    }

    /**
     * Register a replacer
     *
     * @param  \App\Replacers\Replacer[]  $replacers  the array of replacers
     */
    public function register(array $replacers): static
    {
        $this->replacers = [...$this->replacers, ...$replacers];

        return $this;
    }

    /**
     * Render a html string
     *
     * @return string the rendered html string with the replacers
     */
    public function render(): string
    {
        if (! empty($this->replacers)) {
            /** @var \App\Replacers\Replacer $replacer */
            foreach ($this->replacers as $replacer) {
                assert($replacer instanceof ReplacerInterface);
                $this->html = $replacer->run($this->html);
            }
        }

        return $this->html;
    }
}
