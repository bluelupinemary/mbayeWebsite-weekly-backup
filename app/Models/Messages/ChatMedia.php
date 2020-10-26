<?php

namespace App\Models\Messages;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class ChatMedia extends Model
{
    protected $table = 'chat_media';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'filetype',
        'message_id',
        'message_type',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
