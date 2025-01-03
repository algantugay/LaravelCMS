<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 
        'receiver_id', 
        'message', 
        'is_read',
        'conversation_id'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    protected $appends = ['conversation_id'];

    public function getConversationIdAttribute()
    {
        return $this->sender_id < $this->receiver_id 
            ? "{$this->sender_id}-{$this->receiver_id}" 
            : "{$this->receiver_id}-{$this->sender_id}";
    }
}
