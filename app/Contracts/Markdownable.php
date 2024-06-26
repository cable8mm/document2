<?php

namespace App\Contracts;

interface Markdownable
{
    public function toMarkdown(): string;

    public function toHtml(): string;

    public function toHtmlable(): Htmlable|RendererInterface;
}
