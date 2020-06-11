<?php

namespace App\Models\GeneralBlogs;

use App\Models\BaseModel;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Models\GeneralBlogs\Traits\Attribute\GeneralBlogAttribute;
use App\Models\GeneralBlogs\Traits\Relationship\GeneralBlogRelationship;

class GeneralBlog extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        HasTrixRichText,
        GeneralBlogAttribute,
        GeneralBlogRelationship {
            // BlogAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    protected $fillable = [
        'name',
        'slug',
        'publish_datetime',
        'content',
        'meta_title',
        'cannonical_link',
        'meta_keywords',
        'meta_description',
        'status',
        'featured_image',
        'created_by',
    ];

    protected $dates = [
        'publish_datetime',
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
        $this->table = config('module.general_blogs.table');
    }
}
