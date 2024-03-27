<?php

namespace App\Actions;

use App\Contracts\ActionInterface;
use Illuminate\Support\Facades\File;

/**
 * Publish redirecting to default version
 *
 * @example (new PublishDefaultDocAction('/path/to/publish/index.html', '10.x'))->execute()
 */
class PublishDefaultVersionAction implements ActionInterface
{
    /**
     * Constructor
     *
     * @param  string  $publishPath  The root path for the specific version.
     * @param  string  $version  The default version. If beta version is available, but it isn't default version, it will be set to the default version.
     */
    public function __construct(
        protected string $publishPath,
        protected string $version
    ) {

    }

    /**
     * Execute to save redirect file toward default document.
     *
     * @return int|bool Return pages count on success, `false` on failure
     */
    public function execute(): int|bool
    {
        File::ensureDirectoryExists($this->publishPath.DIRECTORY_SEPARATOR.$this->version);

        return File::put(
            $this->publishPath.DIRECTORY_SEPARATOR.'index.html',
            '
            <!DOCTYPE html>
            <html>
              <head>
                    <title>Redirecting...</title>
                        <meta charset="UTF-8" />
                        <meta http-equiv="refresh" content="0; URL=./'.$this->version.'" />
                </head>
                <body>
                    <p>This page has been moved. If you are not redirected within 3 seconds, click <a href="'.$this->version.'">here</a> to go to the correct document.</p>
                </body>
            </html>
            '
        );
    }
}
