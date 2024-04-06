<?php

namespace App\Commands;

use App\Actions\PublishDefaultDocAction;
use App\Actions\PublishDefaultVersionAction;
use App\Support\Config;
use LaravelZero\Framework\Commands\Command;

/**
 * Set default version or default documentation or both.
 *
 * @example ./document2 set
 * @example ./document2 set -b master
 * @example ./document2 set -b master -f installation.md
 */
class SetCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'set
                            {--b|branch= : Set default version, if not specified, `.env` will be used}
                            {--f|filename= : Set default document filename such as `installation.md`, if not specified, `.env` will be used}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Set default version or default document or both.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $branch = $this->option('branch') ?? Config::get('default_version');
        $filename = $this->option('filename') ?? Config::get('default_doc');

        // Set default version
        $this->task('Publishing default version', function () use ($branch) {
            return (new PublishDefaultVersionAction($branch))->execute() !== false;
        });

        // Set default document
        foreach (Config::get('versions') as $version) {
            $this->task('Publishing default file as '.$filename.' in '.$version, function () use ($version, $filename) {
                return (new PublishDefaultDocAction($version, $filename))->execute() !== false;
            });
        }

        $this->comment('Default version and document was set.');

        $this->info('Operation executed.');
    }
}
