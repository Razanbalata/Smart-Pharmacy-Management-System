<?php

namespace App\Services\AI\Prompts;

use App\Services\AI\Contracts\AIPrompt;

class DashboardPrompt implements AIPrompt
{
    public function text(): string
    {
        return <<<PROMPT

            Dashboard Analysis

            Focus on:

            • Overall business health

            • Revenue

            • Profit

            • Inventory health

            • Important risks

            • Executive summary

            Do not discuss product details unless they affect the business.

            PROMPT;
    }
}
