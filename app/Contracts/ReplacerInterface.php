<?php

namespace App\Contracts;

interface ReplacerInterface
{
    public function __construct(string $replace);

    public function run(string $original): string;
}
