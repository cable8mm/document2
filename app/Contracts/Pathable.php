<?php

namespace App\Contracts;

interface Pathable
{
    public function toPath(): string;

    public function toDir(): string;
}
