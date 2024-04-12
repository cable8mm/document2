<?php

namespace App\Actions;

use App\Contracts\ActionInterface;
use App\Support\Reflection;
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
        $driver = Reflection::driver($this->template);

        $baseBath = $driver->getTemplateLocation()->toDir();

        assert(File::exists($baseBath), new InvalidArgumentException(basename($baseBath).' template does not exist'));

        return File::copyDirectory($baseBath, public_path());

    }
}
