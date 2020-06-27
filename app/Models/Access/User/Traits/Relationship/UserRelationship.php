<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\System\Session;
use App\Models\Comment\Comment;
use App\Models\Friendships\Group;
use App\Models\Access\User\SocialLogin;
use App\Models\CareerProfile\CareerProfile;


/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.role_user_table'), 'user_id', 'role_id');
    }

    /**
     * Many-to-Many relations with Permission.
     * ONLY GETS PERMISSIONS ARE NOT ASSOCIATED WITH A ROLE.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(config('access.permission'), config('access.permission_user_table'), 'user_id', 'permission_id');
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialLogin::class);
    }

   

    /**
     * @return mixed
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function comments()
      {
          return $this->hasMany(Comment::class)->whereNull('parent_id');
      }

    public function groups()
      {
          return $this->hasMany(Group::class);
      }

    public function careerprofile()
      {
          return $this->hasOne(CareerProfile::class,'user_id');
      }
}
