<?php

namespace App\Models\CareStoryVideos;

use Illuminate\Database\Eloquent\Model;
use App\Models\CareStories\CareStory;

class CareStoryVideo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'care_stories_videos';

    protected $fillable = [
        'care_story_id',
        'videourl'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function care_story()
    {
        return $this->belongsTo(CareStory::class, 'care_story_id');
    }
}
