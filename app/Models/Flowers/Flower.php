<?php

namespace App\Models\Flowers;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'flowers';

    protected $fillable = [
        'codename',
        'flower_name'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
