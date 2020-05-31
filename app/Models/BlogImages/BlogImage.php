<?php

namespace App\Models\BlogImages;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blog_images';

    protected $fillable = [
        'blog_id',
        'imageurl'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
