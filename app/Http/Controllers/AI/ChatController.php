<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Services\AI\Chat\AIChatManager;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(
        private AIChatManager $chatManager
    ) {}

    /**
     * Chat Page
     */
    public function index()
    {
        return view(
            'ai.chat'
        );
    }

    /**
     * Send Message
     */
    public function message(
        Request $request
    ) {
        $request->validate([
            'message' =>
                'required|string|max:2000',
            'conversation_id' =>
                'nullable|integer'
        ]);

        $response =
            $this->chatManager->chat(
                $request->message,
                $request->conversation_id
            );

        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }
}
