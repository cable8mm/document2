<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
     * The configuration of the command.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setDefinition(
                [
                    new InputArgument('path', InputArgument::IS_ARRAY, 'The path to document2', [(string) getcwd()]),
                    new InputOption('config', '', InputOption::VALUE_REQUIRED, 'The configuration that should be used'),
                    new InputOption('no-config', '', InputOption::VALUE_NONE, 'Disable loading any configuration file'),
                    new InputOption('theme', '', InputOption::VALUE_REQUIRED, 'The output theme that should be used'),
                ]
            );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }
}
