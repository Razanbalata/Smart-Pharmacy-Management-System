<?php

namespace App\Services\AI\Contracts;

interface AIContextBuilder
{
    public function build(): array;
}
