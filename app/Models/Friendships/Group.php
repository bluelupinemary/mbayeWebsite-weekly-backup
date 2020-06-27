<?php

namespace App\Models\Friendships;

use App\Models\Access\User\User;
use App\Models\Friendships\Status;
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
}
