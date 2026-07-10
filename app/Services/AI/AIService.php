<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function generate(string $prompt): array
    {
        $response = Http::withToken(
            config('services.groq.key')
        )
            ->post(
                'https://api.groq.com/openai/v1/chat/completions',
                [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' =>
                                'You are PharmaSmart AI Advisor. 
                    Always return valid JSON only.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.3,
                ]
            );

        if ($response->failed()) {
            throw new \Exception(
                'Groq AI request failed'
            );
        }

        $content =
            $response
                ->json('choices.0.message.content');

        $content = trim($content);

        // Remove markdown json block
        $content = preg_replace(
            '/^```json|```$/',
            '',
            $content
        );

        $content = trim($content);

        $result = json_decode(
            $content,
            true
        );

        if (!is_array($result)) {
            return [
                'success' => false,
                'message' => 'AI returned invalid format',
                'raw' => $content
            ];
        }

        return $result;
    }
}
