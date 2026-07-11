<?php

namespace App\Services\AI\Chat;

use App\Models\AIConversation;
use App\Models\AIMessage;
use App\Services\AI\AIService;
use Illuminate\Support\Facades\Auth;

class AIChatManager
{
    public function __construct(
        private IntentDetector $intentDetector,
        private ContextResolver $contextResolver,
        private ChatPromptBuilder $promptBuilder,
        private AIService $aiService
    ) {}

    public function chat(
        string $message,
        ?int $conversationId = null
    ): array {
        /*
         * |--------------------------------------------------------------------------
         * | Get Or Create Conversation
         * |--------------------------------------------------------------------------
         */

        $conversation = $this->getConversation(
            $conversationId
        );

        /*
         * |--------------------------------------------------------------------------
         * | Save User Message
         * |--------------------------------------------------------------------------
         */

        AIMessage::create([
            'conversation_id' =>
                $conversation->id,
            'role' =>
                'user',
            'content' =>
                $message
        ]);

        /*
         * |--------------------------------------------------------------------------
         * | Detect Intent
         * |--------------------------------------------------------------------------
         */

        $intent =
            $this
                ->intentDetector
                ->detect($message);

        /*
         * |--------------------------------------------------------------------------
         * | Build Context
         * |--------------------------------------------------------------------------
         */

        $context =
            $this
                ->contextResolver
                ->resolve($intent);

        /*
         * |--------------------------------------------------------------------------
         * | Build Prompt
         * |--------------------------------------------------------------------------
         */
        $history =
            $conversation
                ->messages()
                ->latest()
                ->take(10)
                ->get()
                ->reverse()
                ->toArray();
        $prompt =
            $this
                ->promptBuilder
                ->build(
                    $message,
                    $context,
                    $history
                );

        /*
         * |--------------------------------------------------------------------------
         * | Ask AI
         * |--------------------------------------------------------------------------
         */

        $response =
            $this
                ->aiService
                ->generateText($prompt);

        /*
         * |--------------------------------------------------------------------------
         * | Save AI Response
         * |--------------------------------------------------------------------------
         */

        AIMessage::create([
            'conversation_id' =>
                $conversation->id,
            'role' =>
                'assistant',
            'content' =>
                $response,
            'module' =>
                $intent['module'] ?? null
        ]);

        return [
            'conversation_id' =>
                $conversation->id,
            'message' =>
                $response,
            'module' =>
                $intent['module'] ?? null
        ];
    }

    private function getConversation(
        ?int $conversationId
    ) {
        if ($conversationId) {
            return AIConversation::where(
                'id',
                $conversationId
            )
                ->where(
                    'user_id',
                    Auth::id()
                )
                ->firstOrFail();
        }

        return AIConversation::create([
            'user_id' =>
                Auth::id(),
            'pharmacy_id' =>
                Auth::user()->pharmacy_id ?? null,
            'title' =>
                'New AI Conversation'
        ]);
    }
}
