<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use App\Models\AIConversation;
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
        $conversation = AIConversation::with([
            'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }
        ])
            ->where('user_id', auth()->id())
            ->first();

        return view('ai.chat', compact('conversation'));
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
