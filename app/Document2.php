<?php

namespace App;

use App\Markdown\GithubFlavoredMarkdownConverter;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class Document2
{
    /**
     * The filesystem implementation.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * $var string The path for documents(markdown files) root.
     */
    protected string $path;

    /**
     * @var string The default version to be redirected to front page
     */
    protected string $defaultVersion;

    public string $blueprint;

    /**
     * Create a new documentation instance.
     *
     * @param  string  $path  The path for documents(markdown files) root.
     * @return void
     */
    public function __construct(Filesystem $files, string $path, string $defaultVersion)
    {
        $this->files = $files;
        $this->path = $path;
    }

    /**
     * Get the documentation index page.
     */
    public function getIndex(?string $version = null): ?string
    {
        $path = is_null($version)
            ? base_path($this->path.DIRECTORY_SEPARATOR.'documentation.md')
            : base_path($this->path.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR.'documentation.md');

        if ($this->files->exists($this->path)) {
            return $this->replaceLinks($version, (new GithubFlavoredMarkdownConverter())->convert($this->files->get($path)));
        }

        return null;
    }

    /**
     * Get the given documentation page.
     */
    public function get(string $page, ?string $version = null): ?string
    {
        $path = base_path($this->path.DIRECTORY_SEPARATOR.(
            is_null($version)
                ? $page.'.md'
                : $version.DIRECTORY_SEPARATOR.$page.'.md'
        ));

        if ($this->files->exists($path)) {
            $content = $this->files->get($path);

            $content = (new GithubFlavoredMarkdownConverter())->convert($content);

            return is_null($version)
                ? $content
                : $this->replaceLinks($version, $content);
        }

        return null;
    }

    /**
     * Get the array based index representation of the documentation.
     *
     * @param  string  $version
     */
    public function indexArray($version): array
    {
        $path = base_path($this->path.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR.'documentation.md');

        if (! $this->files->exists($path)) {
            return [];
        }

        $collection = collect(explode(PHP_EOL, $this->replaceLinks($version, $this->files->get($path))));

        return [
            'pages' => collect(explode(PHP_EOL, $this->replaceLinks($version, $this->files->get($path))))
                ->filter(fn ($line) => Str::contains($line, '/'.$this->path.'/'))
                ->map(fn ($line) => base_path(Str::of($line)->afterLast('(/')->before(')')->replace('{{version}}', $version)->append('.md')))
                ->filter(fn ($path) => $this->files->exists($path))
                ->mapWithKeys(function ($path) {
                    $contents = $this->files->get($path);

                    preg_match('/\# (?<title>[^\\n]+)/', $contents, $page);
                    preg_match_all('/<a name="(?<fragments>[^"]+)"><\\/a>\n#+ (?<titles>[^\\n]+)/', $contents, $section);

                    return [
                        (string) Str::of($path)->afterLast('/')->before('.md') => [
                            'title' => $page['title'],
                            'sections' => collect($section['fragments'])
                                ->combine($section['titles'])
                                ->map(fn ($title) => ['title' => $title]),
                        ],
                    ];
                }),
        ];
    }

    /**
     * Replace the version place-holder in links.
     *
     * @param  string  $version
     * @param  string  $content
     * @return string
     */
    public static function replaceLinks($version, $content)
    {
        return str_replace('%7B%7Bversion%7D%7D', $version, $content);
    }

    /**
     * Check if the given section exists.
     *
     * @param  string  $version
     * @param  string  $page
     * @return bool
     */
    public function sectionExists($version, $page)
    {
        return $this->files->exists(
            base_path($this->path.DIRECTORY_SEPARATOR.$version.DIRECTORY_SEPARATOR.$page.'.md')
        );
    }

    /**
     * Determine which versions a page exists in.
     *
     * @param  string  $page
     * @return \Illuminate\Support\Collection
     */
    public function versionsContainingPage($page, ?array $versions = null)
    {
        return collect($versions)
            ->filter(function ($version) use ($page) {
                return $this->sectionExists($version, $page);
            });
    }

    /**
     * Get the publicly available versions of the documentation
     *
     * @return array
     */
    public static function getDocVersions()
    {
        return [
            'master' => 'Master',
            '11.x' => '11.x',
            '10.x' => '10.x',
            '9.x' => '9.x',
            '8.x' => '8.x',
            '7.x' => '7.x',
            '6.x' => '6.x',
            // '6.0' => '6.0',
            '5.8' => '5.8',
            '5.7' => '5.7',
            '5.6' => '5.6',
            '5.5' => '5.5',
            '5.4' => '5.4',
            '5.3' => '5.3',
            '5.2' => '5.2',
            '5.1' => '5.1',
            '5.0' => '5.0',
            '4.2' => '4.2',
        ];
    }
}
