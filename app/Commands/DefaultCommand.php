<?php

namespace App\Commands;

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

    }
}
