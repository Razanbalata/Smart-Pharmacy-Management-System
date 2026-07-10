<?php

namespace App\Services\AI\Prompts;

class SalesPrompt
{
    public function text(): string
    {
        return <<<PROMPT

            Sales Analysis

            Focus on:

            • Revenue

            • Orders

            • Average order value

            • Sales trend

            • Best selling products

            • Growth opportunities

            Do not discuss inventory unless it directly impacts sales.

            PROMPT;
    }
}
