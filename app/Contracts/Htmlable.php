<?php

namespace App\Contracts;

interface Htmlable
{
    public function toHtml(): string;
}
