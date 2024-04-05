<?php

namespace App\Drivers;

use App\Contracts\Htmlable;
use App\Enums\NavEnum;
use App\Support\URL;
use App\Types\HtmlString;
use App\Types\MarkdownString;
use App\Types\Nav;
use App\Types\NavCollection;
use Illuminate\Support\Facades\File;

class LaravelDriver extends Driver
{
    /**
     * Get \App\Types\Nav from documentation line
     *
     * @throws \InvalidArgumentException
     *
     * @example '- [Installation](/docs/{{version}}/installation)' : ['title' => 'Installation', 'link' => '/docs/{{version}}/installation', 'section' => 2]
     * @example '- ## Prologue' : ['title' => 'Prologue', 'link' => null, 'section => 1]
     */
    protected static function getNav(string $line): ?Nav
    {
        if (preg_match('/^[\s]*?$/', $line)) {
            return null;
        }

        if (preg_match('/\- \[([^\]]+)\]\(([^)]+)\)/', $line, $matches)) {
            return new Nav(
                $matches[1],
                NavEnum::Page,
                link: $matches[2],
                filename: URL::filenameFromNav($matches[2])
            );
        }

        if (preg_match('/\- ## (.+)/', $line, $matches)) {
            return new Nav(
                $matches[1],
                NavEnum::Section
            );
        }

        throw new \InvalidArgumentException($line.' has been invalid');
    }

    /**
     * {@inheritDoc}
     */
    public static function getNavs(string $path, string $filename): \App\Types\NavCollection
    {
        $documentationMd = File::get(self::getDocumentRoot($path.DIRECTORY_SEPARATOR.self::getNavFile()));

        $collect = collect(explode(PHP_EOL, $documentationMd))
            ->filter(fn ($line) => ! preg_match('/^[\s]*?$/', $line))
            ->map(fn ($line) => self::getNav($line));

        return new NavCollection($collect->toArray(), $filename);
    }

    /**
     * {@inheritDoc}
     */
    public static function getNavFile(): string
    {
        return 'documentation.md';
    }

    /**
     * {@inheritDoc}
     */
    public static function getDocument(string $path, string $filename): array
    {
        $markdown = File::get(self::getDocumentRoot($path.DIRECTORY_SEPARATOR.$filename));

        preg_match('/#(.+)/m', $markdown, $matched);

        $title = $matched[1] ?? '';

        return [
            trim($title),
            new MarkdownString($markdown),
        ];
    }

    /**
     * Get the navigation html
     *
     * @param  \App\Types\NavCollection  $navCollection  The navigation collection
     * @return \App\Contracts\Htmlable The method returns the navigation html
     */
    public static function getNavHtml(NavCollection $navCollection): Htmlable
    {
        $html = '<div class="docs_sidebar"><ul>'.PHP_EOL;

        /* @var <int, \App\Types\Nav[]> $section */
        foreach ($navCollection->toArray() as $section) {
            $html .= '<li'
            .(! empty($section['pages']) && self::inSection($section['pages'], $navCollection->filename) ? ' class="sub--on"' : '')
            .'>'.PHP_EOL;

            $html .= '<h2>'.$section['section']->title.'</h2>'.PHP_EOL;

            $html .= '<ul>'.PHP_EOL;

            foreach ($section['pages'] as $nav) {
                $html .= '<li'
                .($nav->filename === $navCollection->filename ? ' class="active"' : '')
                .'><a href="'.$nav->link.'">'.$nav->title.'</a></li>'.PHP_EOL;
            }

            $html .= '</ul>'.PHP_EOL;

            $html .= '</li>';
        }

        $html .= '</ul></div>';

        return new HtmlString($html);
    }

    /**
     * Whether the filename exists in the section's pages or not
     *
     * @param  array  $pages  The pages
     * @param  string  $filename  The filename
     * @return bool The method returns true if the filename exists in the section and false otherwise
     */
    private static function inSection(array $pages, string $filename): bool
    {
        /* @var \App\Types\Nav[] $pages */
        foreach ($pages as $page) {
            if ($page->filename === $filename) {
                return true;
            }
        }

        return false;
    }
}
