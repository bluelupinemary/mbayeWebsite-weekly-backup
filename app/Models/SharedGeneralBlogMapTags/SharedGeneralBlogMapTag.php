<?php

namespace App\Models\SharedGeneralBlogMapTags;

use Illuminate\Database\Eloquent\Model;

class SharedGeneralBlogMapTag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shared_general_blog_map_tags';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
