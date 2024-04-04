<?php

namespace App\Actions;

use App\Contracts\ActionInterface;
use Illuminate\Support\Facades\File;
use InvalidArgumentException;

/**
 * Copy template action of specific template
 *
 * @example (new CopyTemplateAction('laravel'))->execute()
 */
class CopyTemplateAction implements ActionInterface
{
    /**
     * Constructor
     *
     * @param  string  $template  The template name to copy
     */
    public function __construct(
        protected string $template
    ) {
    }

    /**
     * Execute to copy template files to `public` folder.
     *
     * @return int|bool Return `true` on success, `false` on failure
     *
     * @throws \InvalidArgumentException
     */
    public function execute(): int|bool
    {
        $path = base_path('templates'.DIRECTORY_SEPARATOR.$this->template);

        assert(File::exists($path), new InvalidArgumentException(basename($path).' template does not exist'));

        return File::copyDirectory($path, public_path());
    }
}
