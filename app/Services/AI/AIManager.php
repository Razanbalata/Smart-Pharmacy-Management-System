<?php

namespace App\Services\AI;

class AIManager
{
    public function __construct(
        private AIAnalyzer $analyzer,
        private ModuleRegistry $registry,
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

        $result = $this->analyzer->analyze(
            $module,
            $context
        );
        return array_merge(
            $result,
            [
                'module' => [
                    'name' => $module,
                    'title' => $config['title'],
                    'icon' => $config['icon'],
                    'description' => $config['description'],
                    'color' => $config['color'],
                ],
                'generated_at' => now()->format(
                    'Y-m-d H:i:s'
                )
            ]
        );
    }
}
