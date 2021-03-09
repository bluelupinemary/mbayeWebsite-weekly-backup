<?php

namespace App\Models\CareStoryImages;

use Illuminate\Database\Eloquent\Model;

class CareStoryImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'care_stories_images';

    protected $fillable = [
        'care_story_id',
        'imageurl'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
