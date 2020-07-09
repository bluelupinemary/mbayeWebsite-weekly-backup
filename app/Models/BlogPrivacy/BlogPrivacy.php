<?php

namespace App\Models\BlogPrivacy;

use Illuminate\Database\Eloquent\Model;

class BlogPrivacy extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_privacy';

    protected $fillable = [
        'blog_id',
        'blog_type',
        'group_id'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
