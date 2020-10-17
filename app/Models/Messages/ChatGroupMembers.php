<?php

namespace App\Models\Messages;

use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ChatGroupMembers extends Model
{
    protected $table = 'user_chat_groups';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'group_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
