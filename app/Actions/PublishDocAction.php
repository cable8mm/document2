<?php

namespace App\Actions;

use App\Contracts\ActionInterface;
use App\Page;
use App\Replacers\NavigationReplacer;
use App\Replacers\VersionReplacer;
use App\Support\Renderer;
use Illuminate\Support\Facades\File;

/**
 * Publish action for publishing a html file
 *
 * @example (new PublishAction('/path/to/blueprint/index.html', '/path/to/save', Page instance))
 */
class PublishDocAction implements ActionInterface
{
    protected string $html;

    protected Renderer $renderer;

    /**
     * Constructor
     *
     * @param  string  $blueprint  The full path for blueprint(html)
     * @param  \App\Page[]  $pages  The array of pages
     */
    public function __construct(
        protected string $blueprint,
        protected string $savePath,
        protected ?array $pages = null
    ) {
        $this->html = File::get($blueprint);

        $this->renderer = new Renderer(
            File::get($blueprint)
        );
    }

    /**
     * Add page into $this->pages array
     *
     * @param  Page  $page  The page to add
     */
    public function addPage(Page $page): static
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Execute to save html file.
     *
     * @return int|bool Return pages count on success, `false` on failure
     */
    public function execute(): int|bool
    {
        assert(! empty($this->pages));

        foreach ($this->pages as $page) {
            File::ensureDirectoryExists($this->savePath.DIRECTORY_SEPARATOR.$page->version().DIRECTORY_SEPARATOR.$page->filename());

            if (File::put(
                $this->savePath.DIRECTORY_SEPARATOR.$page->version().DIRECTORY_SEPARATOR.$page->filename().DIRECTORY_SEPARATOR.'index.html',
                $this->renderer->register([
                    new NavigationReplacer($page->navigation()),
                    new VersionReplacer($page->content()),
                ])->render()
            ) === false) {
                return false;
            }
        }

        return count($this->pages);
    }
}
