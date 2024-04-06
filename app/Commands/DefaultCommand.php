<?php

namespace App\Commands;

use App\Document2;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;

/**
 * Generates the html files from markdown documents and set default version and documentation
 *
 * @example ./document2
 * @example ./document2 --template laravel
 */
class DefaultCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'default
                            {--dir=docs : Specify the path for the markdown documentation.}
                            {--template=laravel : Specify the template name for generating HTML files. View all files within the `templates` folder.}
                            {--publish_path=public : Specify the folder where HTML files will be generated.}
                            {--default_version=master : Specify the default version of the documentation. This version will be displayed when the root domain is visited.}
                            {--default_doc=installation.md : Specify the default documentation. This documentation will be displayed when the root documentation path is visited.}
                            {--versions=master : Specify all documentation versions. These must exactly match the Git branch names.}
                            {--current_domain=https://www.laravel.com : Set the current domain link to another website, such as `/api/master`, rather than a documentation.}
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

        $config = [
            'doc_path' => $dir,
            'template' => $this->option('template'),
            'publish_path' => $this->option('publish_path'),
            'default_version' => $this->option('default_version'),
            'default_doc' => $this->option('default_doc'),
            'versions' => array_map('trim', explode(',', $this->option('versions'))),
            'current_domain' => $this->option('current_domain'),
        ];

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

        foreach ((new Document2($config))->save($branch, $filename) as $filename) {
            $filename === false
                ? $this->error('Published '.$filename.' documents failed.')
                : $this->info('Published '.$filename.' documents.');
        }

        $this->info('All documents published.');

        $this->call('set');
    }
}
