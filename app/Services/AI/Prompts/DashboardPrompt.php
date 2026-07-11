<?php

namespace App\Services\AI\Prompts;

class DashboardPrompt
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
