<?php

namespace App;

use App\Contracts\RendererInterface;
use App\Replacers\Replacer;

/**
 * Html rendering engine
 *
 * @example (new Renderer($html))->register([new NavigationReplacer('navigation string')])->render()
 */
class Renderer implements RendererInterface
{
    private array $replacers = [];

    /**
     * Constructor
     *
     * @param  string  $html  the original html string
     */
    public function __construct(
        protected ?string $html = null
    ) {
    }

    public function html(string $html): static
    {
        $this->html = $html;

        return $this;
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
        /** @var \App\Replacers\Replacer $replacer */
        foreach ($this->replacers as $replacer) {
            assert($replacer instanceof Replacer);
            $this->html = $replacer->run($this->html);
        }

        return $this->html;
    }
}
