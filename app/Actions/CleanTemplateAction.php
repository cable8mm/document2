<?php

namespace App\Actions;

use App\Contracts\ActionInterface;
use Illuminate\Support\Facades\File;

/**
 * Clean template files for not templates folder but dest folder
 *
 * @example (new CleanTemplateAction())->execute()
 */
class CleanTemplateAction implements ActionInterface
{
    protected $excludes = [
        '.gitignore',
    ];

    public function __construct(?array $excludes = null)
    {
        if (! is_null($excludes)) {
            $this->excludes = [...$this->excludes, ...$excludes];
        }
    }

    /**
     * Execute to copy template files to `public` folder.
     *
     * @return int|bool Return `true` on success, `false` on failure
     */
    public function execute(): int|bool
    {
        $path = public_path();

        collect(glob($path.DIRECTORY_SEPARATOR.'*'))
            ->filter(function ($item) {
                foreach ($this->excludes as $exclude) {
                    if (strpos($item, $exclude) !== false) {
                        return false;
                    }
                }

                return true;
            })
            ->map(function ($item) {
                File::isFile($item) ? File::delete($item) : File::deleteDirectory($item);
            });

        return true;
    }
}
