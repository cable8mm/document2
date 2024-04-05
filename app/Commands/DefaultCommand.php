<?php

namespace App\Commands;

use App\Document2;
use App\Drivers\LaravelDriver;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

/**
 * Copy
 */
class DefaultCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'default
                            {--d|dir=docs : The directory in markdown files}
                            {--b|branch= : The branch or version of markdown}
                            {--f|filename= : The markdown filename}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Publish documentation to the given path';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $dir = $this->option('dir');
        $branch = $this->option('branch');
        $filename = $this->option('filename');

        // Validate
        if (! File::exists(base_path($dir))) {
            $this->error("The directory {$dir} does not exist");

            return;
        }

        if (! is_null($branch) && ! File::exists(base_path($dir.DIRECTORY_SEPARATOR.$branch))) {
            $this->error("The directory {$dir}/{$branch} does not exist");

            return;
        }

        if (is_null($branch) && ! is_null($filename)) {
            $this->error('The branch is required.');

            return;
        }

        if (! is_null($branch) && ! is_null($filename) && ! File::exists(base_path($dir.DIRECTORY_SEPARATOR.$branch.DIRECTORY_SEPARATOR.$filename))) {
            $this->error("The file {$dir}/{$branch}/{$filename} does not exist");

            return;
        }

        $this->info("The file {$branch}/{$filename}");

        foreach ((new Document2(
            new LaravelDriver
        ))->save($branch, $filename) as $filename) {
            $filename === false
                ? $this->error('Published '.$filename.' documents failed.')
                : $this->info('Published '.$filename.' documents.');
        }

        $this->info('Published documents.');
    }
}
