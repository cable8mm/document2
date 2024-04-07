<?php

namespace App\Commands;

use App\Actions\PublishDefaultDocAction;
use App\Actions\PublishDefaultVersionAction;
use App\Document2;
use App\Support\Config;
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
                            {--dir= : Specify the path for the markdown documentation.}
                            {--template= : Specify the template name for generating HTML files. View all files within the `templates` folder.}
                            {--publish_path= : Specify the folder where HTML files will be generated.}
                            {--default_version= : Specify the default version of the documentation. This version will be displayed when the root domain is visited.}
                            {--default_doc= : Specify the default documentation. This documentation will be displayed when the root documentation path is visited.}
                            {--versions= : Specify all documentation versions. These must exactly match the Git branch names.}
                            {--app_url= : Set the current domain link to another website, such as `/api/master`, rather than a documentation.}
                            {--original_url= : Set the current domain link to another website, such as `/api/master`, rather than a documentation.}
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
    public function handle(Document2 $document2): void
    {
        $branch = $this->option('branch');
        $filename = $this->option('filename');

        $config = [
            'doc_path' => $this->option('dir'),
            'template' => $this->option('template'),
            'publish_path' => $this->option('publish_path'),
            'default_version' => $this->option('default_version'),
            'default_doc' => $this->option('default_doc'),
            'versions' => $this->option('versions') ? array_map('trim', explode(',', $this->option('versions'))) : null,
            'app_url' => $this->option('app_url'),
            'original_url' => $this->option('original_url'),
        ];

        Config::of($config);

        // Validate
        $this->task('Read the configuration', fn () => true);

        if (! File::exists(base_path(Config::get('doc_path')))) {
            $this->error("The directory {Config::get('doc_path')} does not exist");

            return;
        }

        if (! is_null($branch) && ! File::exists(base_path(Config::get('doc_path').DIRECTORY_SEPARATOR.$branch))) {
            $this->error("The directory {Config::get('doc_path')}/{$branch} does not exist");

            return;
        }

        if (is_null($branch) && ! is_null($filename)) {
            $this->error('The branch is required.');

            return;
        }

        if (! is_null($branch) && ! is_null($filename) && ! File::exists(base_path(Config::get('doc_path').DIRECTORY_SEPARATOR.$branch.DIRECTORY_SEPARATOR.$filename))) {
            $this->error('The file '.Config::get('doc_path').'/'.$branch.'/'.$filename.' does not exist');

            return;
        }

        foreach ($document2->save($branch, $filename) as $location) {
            $this->task('Publishing '.$location, function () use ($location) {
                return $location !== false;
            });
        }

        $this->comment('All documents published.');

        // Set default version
        $defaultVersion = Config::get('default_version');

        $this->task('Publish default version', function () use ($defaultVersion) {
            return (new PublishDefaultVersionAction($defaultVersion))->execute() !== false;
        });

        // Set default document
        $defaultDoc = Config::get('default_doc');

        foreach (Config::get('versions') as $version) {
            $this->task('Publish default file as '.$defaultDoc.' in '.$version, function () use ($version, $defaultDoc) {
                return (new PublishDefaultDocAction($version, $defaultDoc))->execute() !== false;
            });
        }

        $this->comment('Default version and document was set.');

        $this->info('Operation executed.');
    }
}
