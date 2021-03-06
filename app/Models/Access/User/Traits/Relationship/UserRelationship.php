<?php

namespace App\Models\Access\User\Traits\Relationship;

use App\Models\System\Session;
use App\Models\Comment\Comment;
use App\Models\Messages\Message;
use App\Models\Friendships\Group;
use App\Models\Messages\ChatGroup;
use App\Models\Company\CompanyProfile;
use App\Models\Access\User\SocialLogin;
use App\Models\Access\User\FeaturedUser;
use App\Models\JobSeekerProfile\JobSeekerProfile;
use App\Models\Messages\GroupMessage;


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
          return $this->hasMany(Group::class, 'created_by');
      }

      public function chatgroups()
      {
          return $this->belongsToMany(ChatGroup::class, 'user_chat_groups','user_id','group_id');
      }

    public function JobSeekerprofile()
      {
          return $this->hasOne(JobSeekerProfile::class,'user_id');
      }

    public function designs()
    {
        return $this->hasMany('App\Models\Game\UserDesignPanel', 'user_id');
    }

    public function company()
    {
        return $this->hasOne(CompanyProfile::class, 'owner_id');
    }

    public function featureduser()
    {
        return $this->hasOne(FeaturedUser::class,'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'sender_id');
    }

    public function groupmessages()
    {
        return $this->hasMany(GroupMessage::class,'sender_id');
    }

    // override the toArray function (called by toJson)
    public function toArray() {
        // get the original array to be displayed
        $data = parent::toArray();

        $data['earthlings_count'] = $this->getFriends()->count();

        return $data;
    }
}