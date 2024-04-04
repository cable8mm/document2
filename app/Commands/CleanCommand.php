<?php

namespace App\Commands;

use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

/**
 * Clean template files for not templates folder but dest folder
 *
 * @example php document2 clean
 */
class CleanCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'clean';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Clean published files';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $path = public_path();

        $excludes = ['.gitignore'];

        $path = public_path();

        collect(glob($path.DIRECTORY_SEPARATOR.'*'))
            ->filter(function ($item) use ($excludes) {
                foreach ($excludes as $exclude) {
                    if (strpos($item, $exclude) !== false) {
                        return false;
                    }
                }

                return true;
            })
            ->map(function ($item) {
                $result = File::isFile($item) ? File::delete($item) : File::deleteDirectory($item);
                $result ? $this->info($item.' was deleted') : $this->error($item.' was failed to be deleted');
            });

        $this->info('Published files cleaned.');
    }
}
