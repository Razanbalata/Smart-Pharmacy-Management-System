<?php

namespace App\Services\AI\Prompts;

class SuppliersPrompt
{
    public function text(): string
    {
        return <<<PROMPT

            Suppliers Intelligence Module

            Analyze supplier performance and supplier management in the pharmacy.

            Focus on:

            - Supplier activity level
            - Supplier reliability indicators
            - Purchase dependency risks
            - Supplier contribution to purchasing
            - Inactive suppliers
            - Supplier relationship optimization
            - Purchasing distribution between suppliers


            Business Analysis Rules:

            - Analyze suppliers only.
            - Do not analyze sales performance.
            - Do not assume a supplier is bad without evidence.
            - Use purchase data to evaluate supplier importance.
            - Identify dependency risks when purchases are concentrated.
            - Highlight inactive suppliers when relevant.
            - Provide recommendations to improve supplier management.
            - Base every conclusion only on the provided data.


            Examples of useful insights:

            - A supplier represents a large percentage of purchasing activity.
            - Some suppliers have no purchase activity.
            - The pharmacy may benefit from diversifying suppliers.
            - Supplier relationships should be reviewed based on purchasing patterns.


            PROMPT;
    }
}
