<?php

namespace App\Models\BlogDesignPanels;

use App\Models\BaseModel;
use App\Models\ModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use App\Models\BlogDesignPanels\Traits\Attribute\BlogDesignPanelAttribute;
use App\Models\BlogDesignPanels\Traits\Relationship\BlogDesignPanelRelationship;

class BlogDesignPanel extends BaseModel
{
    use ModelTrait,
        SoftDeletes,
        HasTrixRichText,
        BlogDesignPanelAttribute,
        BlogDesignPanelRelationship {
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
        $this->table = config('module.blog_panel_design.table');
    }
}
