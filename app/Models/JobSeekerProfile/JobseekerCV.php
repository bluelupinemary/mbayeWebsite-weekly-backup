<?php

namespace App\Models\JobSeekerProfile;

use Illuminate\Database\Eloquent\Model;

class JobseekerCV extends Model
{
    public function jobseeker()
    {
        return $this->belongsTo(JobSeekerProfile::class, 'jobseeker_profile_id');
    }
    protected $fillable = [

        'jobseeker_profile_id',
        'filename',
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
    protected $table = 'jobseekers_cv';
}
