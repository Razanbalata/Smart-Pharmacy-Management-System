<?php

namespace App\Services\AI;

use App\Services\AI\Contexts\DashboardContextBuilder;
use App\Services\AI\AIService;
use App\Services\AI\PromptBuilder;

class AIManager
{
    public function __construct(
        private DashboardContextBuilder $dashboardContextBuilder,
        private PromptBuilder $promptBuilder,
        private AIService $aiService,
        private AIResponseFormatter $formatter
    ) {}

    public function analyze(string $module): array
    {
        $module = strtolower($module);
        $context = match ($module) {
            'dashboard' =>
                $this->dashboardContextBuilder->build(),

            default =>
                throw new \Exception('Unsupported AI module'),
        };

        $prompt = $this->promptBuilder->build(
            $module,
            $context
        );

        $response = $this->aiService->generate($prompt);

        return $this->formatter->format($response,$context);
    }
}
