<?php

namespace App\Models\Access\User\Traits\Scope;

use Illuminate\Support\Facades\DB;
use App\Models\Access\User\FeaturedUser;

/**
 * Class UserScope.
 */
trait UserScope
{
    /**
     * @param $query
     * @param bool $confirmed
     *
     * @return mixed
     */
    public function scopeConfirmed($query, $confirmed = true)
    {
        return $query->where('confirmed', $confirmed);
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where(config('access.users_table').'.status', $status);
    }

    public function scopeFeatured($query)
    {
        return $query->join('featured_users', function($join)
            {
                $join->on('users.id', '=', 'featured_users.user_id');
            });
    }
}
