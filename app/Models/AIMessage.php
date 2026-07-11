<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIMessage extends Model
{
    protected $table = 'ai_messages';
    protected $fillable = [
        'conversation_id',
        'role',
        'content',
        'module',
        'tokens'
    ];

    public function conversation()
    {
        return $this->belongsTo(
            AIConversation::class
        );
    }
}
