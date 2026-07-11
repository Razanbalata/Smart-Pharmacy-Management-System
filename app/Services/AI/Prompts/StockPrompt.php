<?php

namespace App\Services\AI\Prompts;

use App\Services\AI\Contracts\AIPrompt;

class StockPrompt implements AIPrompt
{
    public function text(): string
    {
        return <<<PROMPT

            Stock Intelligence Analysis:

            You are analyzing pharmacy stock movement activity.

            Your goal is to understand how inventory is moving,
            identify risks, and provide management recommendations.

            Analyze:

            - Stock movement frequency.
            - Purchase vs sales movement behavior.
            - Damaged products impact.
            - Expired products impact.
            - Stock adjustments patterns.
            - Products with unusual movement activity.
            - Inventory control risks.


            Important Rules:

            - Do not analyze sales revenue.
            - Do not calculate profit.
            - Do not assume a movement is negative without evidence.
            - Damaged and expired movements represent potential inventory loss.
            - Adjustments may indicate inventory corrections and should be monitored.
            - Focus only on stock flow behavior.


            Provide:

            - Current stock movement health.
            - Important alerts.
            - Operational risks.
            - Recommendations to improve inventory control.


            PROMPT;
    }
}
