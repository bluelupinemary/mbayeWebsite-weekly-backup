<?php

namespace App\Models\CareStories;

use Illuminate\Database\Eloquent\Model;
use App\Models\CareStories\Traits\Attribute\CareStoryAttribute;
use App\Models\CareStories\Traits\Relationship\CareStoryRelationShip;
use App\Models\ModelTrait;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use Illuminate\Database\Eloquent\SoftDeletes;

class CareStory extends Model
{
    use ModelTrait,
        SoftDeletes,
        HasTrixRichText,
        CareStoryAttribute,
        CareStoryRelationShip {
            // BlogAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    protected $fillable = [
        'name',
        'publish_datetime',
        'featured_image',
        'panel_number',
        'content',
        'meta_title',
        'cannonical_link',
        'slug',
        'meta_description',
        'meta_keywords',
        'status',
        'go_fund_me_link',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'publish_datetime',
        'created_at',
        'updated_at',
        'deleted_at',
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
        $this->table = config('module.care_stories.table');
    }
}
