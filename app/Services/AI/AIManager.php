<?php

namespace App\Services\AI;

class AIManager
{
    public function __construct(
        private ModuleRegistry $registry,
        private PromptBuilder $promptBuilder,
        private AIService $aiService,
        private AIResponseFormatter $formatter
    ) {}

    public function analyze(string $module): array
    {
        /*
         * |
         * | Get Module Configuration
         * |
         */

        $config = $this->registry->get($module);

        /*
         * |
         * | Build Context
         * |
         */

        $contextBuilder = app(
            $config['context']
        );

        $context = $contextBuilder->build();

        /*
         * |
         * | Build Prompt
         * |
         */

        $prompt = $this->promptBuilder->build(
            $module,
            $context
        );

        /*
         * |
         * | AI Request
         * |
         */

        $response = $this->aiService->generate(
            $prompt
        );

        $result = $this->formatter->format(
            $response,
            $context
        );

        return array_merge(
            $result,
            [
                'module' => [
                    'name' => $module,
                    'title' => $config['title'],
                    'icon' => $config['icon'],
                ],
                'generated_at' => now()->format(
                    'Y-m-d H:i:s'
                )
            ]
        );
    }
}
