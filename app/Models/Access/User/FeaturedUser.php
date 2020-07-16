<?php

namespace App\Models\Access\User;

use App\Models\BaseModel;
use App\Models\Access\User\User;

/**
 * Class User.
 */
class FeaturedUser extends BaseModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'featured_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'created_by',
        'updated_by',
        
     
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }  
}
