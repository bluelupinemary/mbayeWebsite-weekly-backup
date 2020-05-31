<?php

namespace App\Models\BlogVideos;

use Illuminate\Database\Eloquent\Model;

class BlogVideo extends Model
{
    protected $fillable = [
        'blog_id',
        'videourl'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.blog_videos.table');
    }
}
