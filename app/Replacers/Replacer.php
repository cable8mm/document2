<?php

namespace App\Replacers;

use App\Contracts\ReplacerInterface;

abstract class Replacer implements ReplacerInterface
{
    public function __construct(
        protected string $replace
    ) {

    }

    abstract public function run(string $original): string;
}
