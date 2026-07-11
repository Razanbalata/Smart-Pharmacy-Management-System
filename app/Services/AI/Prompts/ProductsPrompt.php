<?php

namespace App\Services\AI\Prompts;

class ProductsPrompt
{
    public function text(): string
    {
        return <<<PROMPT

            Products Analysis

            Focus on:

            • Stock levels

            • Low stock

            • Overstock

            • Inventory value

            • Expiring products

            • Product distribution

            • Inventory optimization

            Do not analyze sales unless inventory data clearly relates to them.

            PROMPT;
    }
}
