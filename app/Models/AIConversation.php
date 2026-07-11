<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIConversation extends Model
{
    protected $table = 'ai_conversations';
    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(
            AIMessage::class,
            'conversation_id'
        );
    }
}
