<?php

namespace App\Commands;

use App\Actions\CopyTemplateAction;
use LaravelZero\Framework\Commands\Command;

/**
 * Copy specific template to public folder
 *
 * @example php document2 template
 */
class TemplateCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'template {template : template name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Copy specific template files to public folder';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            (new CopyTemplateAction($this->argument('template')))->execute();

            $this->info('Operation executed');
        } catch (\InvalidArgumentException $e) {
            $this->error($e->getMessage());
        }
    }
}
