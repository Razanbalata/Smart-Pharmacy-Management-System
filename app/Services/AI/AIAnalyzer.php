<?php

namespace App\Services\AI;

class AIAnalyzer
{
    public function __construct(
        private PromptBuilder $promptBuilder,
        private AIService $aiService,
        private AIResponseFormatter $formatter,
    ) {}

    public function analyze(
        string $module,
        array $context,
    ): array {
        $prompt = $this->promptBuilder->build(
            $module,
            $context
        );

        $response = $this->aiService->generate(
            $prompt
        );

        return $this->formatter->format(
            $response,
            $context
        );
    }
}
