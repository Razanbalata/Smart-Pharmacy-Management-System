<?php

namespace App\Services\AI\Chat;

class ChatPromptBuilder
{
    public function build(
        string $message,
        array $context,
        array $history = []
    ): string {
        return <<<PROMPT

            You are PharmaSmart AI Assistant.

            You are an intelligent assistant for pharmacy management.

            Your job:
            - Answer pharmacy management questions.
            - Help users understand their business data.
            - Provide practical recommendations.
            - Use only provided information.
            - Never invent numbers or data.


            Rules:

            1. Use only the provided pharmacy context.
            2. If information is missing, say that clearly.
            3. Keep answers professional and concise.
            4. Think like an experienced pharmacy manager.
            5. Explain the reason behind recommendations.



            Conversation History:

            {$this->formatHistory($history)}



            Current Pharmacy Data:

            {$this->formatContext($context)}



            User Question:

            {$message}



            Answer the user directly.

            PROMPT;
    }

    private function formatContext(array $context): string
    {
        return json_encode(
            $context,
            JSON_PRETTY_PRINT
                | JSON_UNESCAPED_UNICODE
        );
    }

    private function formatHistory(array $history): string
    {
        if (empty($history)) {
            return 'No previous messages';
        }

        $messages = [];

        foreach ($history as $item) {
            $messages[] =
                strtoupper($item['role'])
                . ': '
                . $item['content'];
        }

        return implode(
            "\n",
            $messages
        );
    }
}
