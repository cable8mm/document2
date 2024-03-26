<?php

namespace App\Contracts;

interface RendererInterface
{
    public function register(array $replacers): static;

    public function render(): string;
}
