<?php

namespace App\Commands;

use App\Document2;
use App\Drivers\LaravelDriver;
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
    protected $signature = 'default';

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
        foreach ((new Document2(
            new LaravelDriver
        ))->save() as $filename) {
            $filename === false
                ? $this->error('Published '.$filename.' documents failed.')
                : $this->info('Published '.$filename.' documents.');
        }

        $this->info('Published documents.');
    }
}
