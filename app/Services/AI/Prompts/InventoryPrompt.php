<?php

namespace App\Services\AI\Prompts;

use App\Services\AI\Contracts\AIPrompt;

class InventoryPrompt implements AIPrompt
{
    public function text(): string
    {
        return <<<PROMPT

            Inventory Intelligence Module

            Analyze the pharmacy inventory health and stock management performance.

            Your goal is to help the pharmacy manager understand:
            - Inventory risks
            - Stock optimization opportunities
            - Capital utilization
            - Product movement patterns


            Analyze the following areas:

            1. Stock Availability:
            - Identify low stock products.
            - Identify out of stock risks.
            - Determine whether inventory levels appear healthy.

            2. Expiration Management:
            - Detect products approaching expiration.
            - Highlight possible inventory waste risks.

            3. Inventory Value:
            - Consider inventory as invested capital.
            - Explain whether inventory value requires attention.
            - Do not consider purchasing inventory as a direct loss.

            4. Stock Movement:
            - Analyze purchase, sale, adjustment, damaged, expired and return movements.
            - Identify unusual movement patterns when available.

            5. Optimization:
            - Suggest practical inventory improvements.
            - Recommend better stock monitoring strategies.


            Business Rules:

            - Analyze inventory only.
            - Do not analyze sales performance unless movement data is provided.
            - Do not invent demand patterns.
            - Do not assume overstock unless supported by the data.
            - Use only provided inventory information.
            - Recommendations must be practical for pharmacy management.


            Examples of useful insights:

            - Some products have stock levels below their minimum threshold.
            - Inventory value represents a significant amount of invested capital.
            - Expiring products should be reviewed before financial loss occurs.
            - Stock movements indicate areas requiring better monitoring.


            PROMPT;
    }
}
