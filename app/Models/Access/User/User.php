<?php

namespace App\Models\Access\User;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\Access\User\Traits\UserAccess;
use App\Models\Friendships\Traits\Friendable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\Traits\Scope\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\UserSendPasswordReset;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use App\Models\Friendships\Friendship;
use App\Models\Friendships\Status;
use Illuminate\Support\Facades\Auth;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use UserScope,
        UserAccess,
        Notifiable,
        SoftDeletes,
        UserAttribute,
        UserRelationship,
        UserSendPasswordReset,
        Friendable,
        HasApiTokens;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'status',
        'dob',
        'address',
        'country',
        'id_number',
        'sponser_id',
        'sponser_name',
        'mobile_number',
        'org_type',
        'org_name',
        'photo',
        'occupation',
        'member_type',
        'gender',
        'confirmation_code',
        'confirmed',
        'created_by',
        'updated_by',
        'is_term_accept',
        'username',
     
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    // protected $appends = ['user_friendship'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.users_table');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'id'                => $this->id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'username'          => $this->username,
        //  'is_term_accept'    => $this->is_term_accept,
            'email'             => $this->email,
            'photo'             => $this->photo,
            'confirmed'         => $this->confirmed,
            'role'              => optional($this->roles()->first())->name,
            'permissions'       => $this->permissions()->get(),
            'status'            => $this->status,
            'created_at'        => $this->created_at->toIso8601String(),
            'updated_at'        => $this->updated_at->toIso8601String(),
        ];
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }

    public function getUserFriendshipAttribute()
    {
        $user = Auth::user();
        $friendship = Friendship::where(function ($query) {
                    $query->where(function ($q) {
                        $q->whereSender($this);
                    })->orWhere(function ($q) {
                        $q->whereRecipient($this);
                    });
                })
                ->where(function ($query) use($user) {
                    $query->where(function ($q) use($user) {
                        $q->whereSender($user);
                    })->orWhere(function ($q) use($user) {
                        $q->whereRecipient($user);
                    });
                })
                ->where('status', Status::ACCEPTED)
                ->first();

        if($friendship) {
            return $friendship->updated_at;
        }
    }
}
