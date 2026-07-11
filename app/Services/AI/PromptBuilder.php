<?php

namespace App\Services\AI;

use App\Services\AI\Prompts\BasePrompt;

class PromptBuilder
{
    public function __construct(
        private BasePrompt $basePrompt,
        private ModuleRegistry $registry
    ) {}

    public function build(
        string $module,
        array $context
    ): string {
        /*
         * |
         * | Get Module Prompt
         * |
         */

        $config = $this->registry->get($module);

        $modulePrompt = app(
            $config['prompt']
        );

        return implode("\n\n", [
            // General AI Rules
            $this->basePrompt->text(),
            // Module Intelligence
            $modulePrompt->text(),
            // Module Name
            "Current Module: {$module}",
            // Pharmacy Data
            'Data:',
            json_encode(
                $context,
                JSON_PRETTY_PRINT
            )
        ]);
    }
}
