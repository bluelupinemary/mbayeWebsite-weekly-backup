<?php

namespace App\Models\UserInterest;

use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = "user_interests";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'primary_interests','	secondary_interests','other_interests'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
