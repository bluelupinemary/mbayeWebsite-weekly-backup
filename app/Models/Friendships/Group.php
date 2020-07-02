<?php

namespace App\Models\Friendships;

use App\Models\Access\User\User;
use App\Models\Friendships\Status;
use App\Models\Friendships\FriendFriendshipGroups;
use Illuminate\Database\Eloquent\Model;


class Group extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'created_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->table = config('friendships.tables.groups');

        parent::__construct($attributes);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getMembers()
    {
        $members = FriendFriendshipGroups::where('group_id', $this->id)->pluck('friend_id');
        $users = User::whereIn('id', $members)->orderBy('first_name', 'asc')->get();

        return $users;
    }
}
