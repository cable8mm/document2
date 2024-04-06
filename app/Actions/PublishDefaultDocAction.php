<?php

namespace App\Actions;

use App\Contracts\ActionInterface;
use App\Page;
use App\Support\Config;
use App\Support\Path;
use App\Support\Reflection;
use Illuminate\Support\Facades\File;

/**
 * Publish redirecting to default documentation
 *
 * @example (new PublishDefaultDocAction('10.x', 'installation.md'))->execute()
 */
class PublishDefaultDocAction implements ActionInterface
{
    /**
     * Constructor
     *
     * @param  string  $publishPath  The root path for the specific version.
     * @param  string  $version  The documentation version.
     * @param  string  $filename  The default document filename without `.md`. If the first documentation isn't default, it will be set to the default documentation.
     */
    public function __construct(
        protected string $version,
        protected string $filename
    ) {

    }

    /**
     * Execute to save redirect file toward default document.
     *
     * @return int|bool Return pages count on success, `false` on failure
     */
    public function execute(): int|bool
    {
        if ((new Page(
            $this->filename,
            $this->version,
            Reflection::driver(Config::get('template'))
        ))->toFrontFile() === false) {
            return false;
        }

        return 1;
    }
}
