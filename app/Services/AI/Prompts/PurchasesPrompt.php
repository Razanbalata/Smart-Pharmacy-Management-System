<?php

namespace App\Services\AI\Prompts;

use App\Services\AI\Contracts\AIPrompt;

class PurchasesPrompt implements AIPrompt
{
    public function text(): string
    {
        return <<<PROMPT

            Purchases Intelligence Module

            Analyze the pharmacy purchasing performance only.

            Focus on:

            - Purchase order activity
            - Purchasing efficiency
            - Supplier contribution
            - Inventory investment
            - Pending purchase orders
            - Purchasing trends
            - Frequently purchased products
            - Cost optimization opportunities

            Important rules:

            - Do not analyze sales unless sales data is provided.
            - Do not assume purchases are business losses.
            - Inventory purchased is considered an investment.
            - Highlight excessive inventory investment when appropriate.
            - Mention supplier concentration if one supplier dominates purchases.
            - Mention pending purchase orders if they may affect inventory.
            - Recommend purchasing improvements when necessary.
            - Base every conclusion only on the provided data.

            PROMPT;
    }
}
