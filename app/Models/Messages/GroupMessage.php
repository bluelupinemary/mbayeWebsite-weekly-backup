<?php

namespace App\Models\Messages;

use App\Models\Access\User\User;
use App\Models\Messages\ChatMedia;
use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $table = 'group_messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'message',
        'group_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function chatmedia()
    {
        return $this->hasOne(ChatMedia::class,'message_id')->where('message_type',GroupMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
