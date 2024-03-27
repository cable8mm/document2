<?php

namespace App\Commands;

use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

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

        array_map(function ($location) use ($excludes) {
            if (! in_array(basename($location), $excludes)) {
                if (File::deleteDirectory($location)) {
                    $this->info($location.' was deleted');
                } else {
                    $this->error($location.' was failed to be deleted');
                }
            }
        }, array_filter((array) glob($path.DIRECTORY_SEPARATOR.'*')));

        $this->info('Published files cleaned.');
    }
}
