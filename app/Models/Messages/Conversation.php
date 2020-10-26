<?php

namespace App\Models\Messages;

use App\Models\Access\User\User;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user1_id',
        'user2_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
