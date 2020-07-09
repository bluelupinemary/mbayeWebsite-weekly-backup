<?php

namespace App\Models\BlogShares;

use Illuminate\Database\Eloquent\Model;

class BlogShare extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_shares';

    protected $fillable = [
        'blog_id',
        'caption',
        'created_by'
    ];

    protected $dates = [
        'publish_datetime',
        'created_at',
        'updated_at'
    ];
}
