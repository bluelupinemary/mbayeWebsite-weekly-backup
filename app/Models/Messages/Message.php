<?php

namespace App\Models\Messages;

use App\Models\Access\User\User;
use App\Models\Messages\ChatMedia;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'message',
        'conversation_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chatmedia()
    {
        return $this->hasOne(ChatMedia::class)->where('message_type',Message::class);
    }
}
