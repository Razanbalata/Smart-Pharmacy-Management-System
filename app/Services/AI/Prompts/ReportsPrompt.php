<?php

namespace App\Services\AI\Prompts;

class ReportsPrompt
{
    public function text(): string
    {
        return <<<PROMPT


            Reports Intelligence Module


            Analyze pharmacy business performance using historical report data.


            Focus on:


            Financial Performance:

            - Revenue
            - Cost
            - Profit
            - Profit margin
            - Business health


            Sales Performance:

            - Number of completed sales
            - Best selling products
            - Sales opportunities


            Management Insights:

            - Identify positive trends
            - Identify risks
            - Suggest business improvements



            Rules:


            - Use only provided report data.
            - Do not invent trends.
            - Do not assume customer behavior.
            - Explain financial numbers clearly.
            - Consider pharmacy business logic.
            - Recommendations must be actionable.



            PROMPT;
    }
}
