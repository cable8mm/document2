<?php

namespace App\Drivers;

use App\Contracts\Htmlable;
use App\Enums\NavEnum;
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
                $matches[2]
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
    public static function getNavs(?string $path = null): \App\Types\NavCollection
    {
        $documentationMd = File::get(self::getDocumentRoot($path.DIRECTORY_SEPARATOR.self::getNavFile()));

        $collect = collect(explode(PHP_EOL, $documentationMd))
            ->filter(fn ($line) => ! preg_match('/^[\s]*?$/', $line))
            ->map(fn ($line) => self::getNav($line));

        return new NavCollection($collect->toArray());
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

        $title = trim($matched[1]);

        return [
            $title,
            new MarkdownString(File::get(self::getDocumentRoot($path.DIRECTORY_SEPARATOR.$filename))),
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

        foreach ($navCollection->toArray() as $section) {
            $html .= '<li>'.PHP_EOL;

            $html .= '<h2>'.$section['section']->title.'</h2>'.PHP_EOL;

            $html .= '<ul>'.PHP_EOL;

            foreach ($section['pages'] as $nav) {
                $html .= '<li><a href="'.$nav->link.'">'.$nav->title.'</a></li>'.PHP_EOL;
            }

            $html .= '</ul>'.PHP_EOL;

            $html .= '</li>';
        }

        $html .= '</ul></div>';

        return new HtmlString($html);
    }
}
