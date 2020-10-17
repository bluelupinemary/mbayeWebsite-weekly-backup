<?php

namespace App\Models\Messages;

use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    protected $table = 'chat_groups';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'created_by',
        'image,'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function members()
    {
        return $this->belongsToMany(User::class,'user_chat_groups','user_id','group_id');
    }

    public function getMembers()
    {
        $members = DB::table('user_chat_groups')->where('group_id', $this->id)->pluck('user_id');
        $users = User::whereIn('id', $members)->orderBy('first_name', 'asc')->get();

        return $users;
    }
}
