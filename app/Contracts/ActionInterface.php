<?php

namespace App\Contracts;

interface ActionInterface
{
    public function execute(): int|bool;
}
