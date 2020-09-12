<?php
namespace App\Models\Friendships\Traits;
use Exception;
use App\Models\Friendships\Group;
use App\Models\Friendships\Status;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use App\Models\Friendships\Friendship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\Paginator;
use App\Models\Friendships\FriendFriendshipGroups;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Frontend\Paginate\PaginateRepository;
use Auth;


trait Friendable
{
    
    public function befriend(Model $recipient)
    {
        if (!$this->canBefriend($recipient)) {
            return false;
        }
        $friendship = (new Friendship)->fillRecipient($recipient)->fill([
            'status' => Status::PENDING,
        ]);
        $this->friends()->save($friendship);
        // event(new Sent($this, $recipient));
        return $friendship;
    }

    /**
     * @param Model $recipient
     *
     * @return bool
     */
    public function unfriend(Model $recipient)
    {
        $deleted = $this->findFriendship($recipient)->delete();
        // event(new Cancelled($this, $recipient));
        return $deleted;
    }

    /**
     * @param Model $recipient
     *
     * @return bool
     */
    public function hasFriendRequestFrom(Model $recipient)
    {
        return $this->findFriendship($recipient)->whereSender($recipient)->whereStatus(Status::PENDING)->exists();
    }

    /**
     * @param Model $recipient
     *
     * @return bool
     */
    public function hasSentFriendRequestTo(Model $recipient)
    {
        return Friendship::whereRecipient($recipient)->whereSender($this)->whereStatus(Status::PENDING)->exists();
    }

    /**
     * @param Model $recipient
     *
     * @return bool
     */
    public function isFriendWith(Model $recipient)
    {
        return Friendship::whereRecipient($this)->whereSender($recipient)->whereStatus(Status::ACCEPTED)->exists();
    }

    /**
     * @param Model $recipient
     *
     * @return bool|int
     */
    public function acceptFriendRequest(Model $recipient)
    {
        $updated = $this->findFriendship($recipient)->whereRecipient($this)->update([
            'status' => Status::ACCEPTED,
        ]);
        // event(new Accepted($this, $recipient));
        return $updated;
    }

    /**
     * @param Model $recipient
     *
     * @return bool|int
     */
    public function denyFriendRequest(Model $recipient)
    {
        $updated = $this->findFriendship($recipient)->whereRecipient($this)->update([
            'status' => Status::DENIED,
        ]);
        // event(new Denied($this, $recipient));
        return $updated;
    }


    /**
     * @param Model $friend
     * @param $groupSlug
     * @return bool
     */
    public function groupFriend(Model $friend, $groupid)
    {
        $friendship       = $this->findFriendship($friend)->whereStatus(Status::ACCEPTED)->first();
        // $groupsAvailable = $groupid;
        if (!isset($groupid) || empty($friendship)) {
            return false;
        }
        $group = $friendship->groups()->firstOrCreate([
            'friendship_id' => $friendship->id,
            'group_id'      => $groupid,
            'friend_id'     => $friend->getKey(),
            'friend_type'   => $friend->getMorphClass(),
        ]);
        return $group->wasRecentlyCreated;
    }

    /**
     * @param Model $friend
     * @param $groupSlug
     * @return bool
     */
    public function ungroupFriend(Model $friend, $groupid)
    {
        $friendship       = $this->findFriendship($friend)->whereStatus(Status::ACCEPTED)->first();
        // $groupsAvailable = Group::where('slug',$groupSlug)->first();
        if (empty($friendship) || $groupid == '') {
            return false;
        }
        $match = [
            'friendship_id' => $friendship->id,
            'friend_id'     => $friend->getKey(),
            'friend_type'   => $friend->getMorphClass(),
            'group_id'      => $groupid,
        ];
        $result = $friendship->groups()->where($match)->delete();
        return $result;
    }

   
    public function blockFriend(Model $recipient)
    {
        // if there is a friendship between the two users and the sender is not blocked
        // by the recipient user then delete the friendship
        if (!$this->isBlockedBy($recipient)) {
            $this->findFriendship($recipient)->delete();
        }
        $friendship = (new Friendship)->fillRecipient($recipient)->fill([
            'status' => Status::BLOCKED,
        ]);
        $this->friends()->save($friendship);
        // event(new Blocked($this, $recipient));
        return $friendship;
    }

    /**
     * @param Model $recipient
     *
     * @return mixed
     */
    public function unblockFriend(Model $recipient)
    {
        $deleted = $this->findFriendship($recipient)->whereSender($this)->delete();
        // event(new Unblocked($this, $recipient));
        return $deleted;
    }

    /**
     * @param Model $recipient
     *
     * @return \Demency\Friendships\Models\Friendship
     */
    public function getFriendship(Model $recipient)
    {
        return $this->findFriendship($recipient)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     * @param string $groupSlug
     *
     */
    public function getAllFriendships($groupSlug = '')
    {
        return $this->findFriendships(null, $groupSlug)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     * @param string $groupSlug
     *
     */
    public function getPendingFriendships($groupSlug = '')
    {
        return $this->findFriendships(Status::PENDING, $groupSlug)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     * @param string $groupSlug
     *
     */
    public function getAcceptedFriendships($groupSlug = '')
    {
        return $this->findFriendships(Status::ACCEPTED, $groupSlug)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     */
    public function getDeniedFriendships()
    {
        return $this->findFriendships(Status::DENIED)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     *
     */
    public function getBlockedFriendships()
    {
        return $this->findFriendships(Status::BLOCKED)->get();
    }

    /**
     * @param Model $recipient
     *
     * @return bool
     */
    public function hasBlocked(Model $recipient)
    {
        return $this->friends()->whereRecipient($recipient)->whereStatus(Status::BLOCKED)->exists();
    }

    /**
     * @param Model $recipient
     *
     * @return bool
     */
    public function isBlockedBy(Model $recipient)
    {
        return $recipient->hasBlocked($this);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Friendship[]
     */
    public function getFriendRequests()
    {
        return Friendship::whereRecipient($this)->whereStatus(Status::PENDING)->paginate(15);
    }

    /**
     * This method will not return Friendship models
     * It will return the 'friends' models. ex: App\User
     *
     * @param int $perPage Number
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFriends($perPage = 0, $groupSlug = '')
    {
        return $this->getOrPaginate($this->getFriendsQueryBuilder($groupSlug), $perPage);
    }

    public function getFriendsSearch($perPage = 0, $search = '', $orderBy) 
    {
        // return $this->getOrPaginate($this->getFriendsSearchQueryBuilder($search, $orderBy), $perPage);
        $orderBy = explode('-', $orderBy);
        $sort_type = $orderBy[0];
        $sort_field = $orderBy[1];

        $friendships = $this->findFriendships(Status::ACCEPTED)->get(['sender_id', 'recipient_id']);
        $recipients  = $friendships->pluck('recipient_id')->all();
        $senders     = $friendships->pluck('sender_id')->all();

        $users =  $this->where('id', '!=', $this->getKey())
            ->whereIn('id', array_merge($recipients, $senders))
            ->when($search, function($query, $search) {
                return  $query->where(function ($q) use ($search) {
                    return $q->where('username','LIKE','%'.$search.'%')
                        ->orWhere('email','LIKE','%'.$search.'%')
                        ->orWhere('first_name','LIKE','%'.$search.'%')
                        ->orWhere('last_name','LIKE','%'.$search.'%');
                });
            })
            ->when($sort_field, function($query) use($sort_field, $sort_type) {
                if($sort_field == 'first_name') {
                    return $query->orderBy($sort_field, $sort_type);
                }
            })
            ->get();
        $users->each->append('user_friendship');
    
        if($sort_field == 'friendship_date') {
            if($sort_type == 'asc') {
                $users = $users->sortBy('user_friendship');
            } else if($sort_type == 'desc') {
                $users = $users->sortByDesc('user_friendship');
            }
        }
        
        $users = $users->paginate($perPage);
        
        return $users;
    }

    public function getUserFriendshipAttribute()
    {
        $user = Auth::user();
        $friendship = $this->findFriendships(Status::ACCEPTED)
                ->where(function ($query) use($user) {
                    $query->where(function ($q) use($user) {
                        $q->whereSender($user);
                    })->orWhere(function ($q) use($user) {
                        $q->whereRecipient($user);
                    });
                })
                ->first();

        return $friendship->updated_at;
    }

    public function getReq($perPage = 0, $groupSlug = '')
    {
        return $this->getOrPaginate($this->getReqQueryBuilder($groupSlug), $perPage);
    }

    /**
     * This method will not return Friendship models
     * It will return the 'friends' models. ex: App\User
     *
     * @param int $perPage Number
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMutualFriends(Model $other, $perPage = 0)
    {
        return $this->getOrPaginate($this->getMutualFriendsQueryBuilder($other), $perPage);
    }

    /**
     * Get the number of friends
     *
     * @return integer
     */
    public function getMutualFriendsCount($other)
    {
        return $this->getMutualFriendsQueryBuilder($other)->count();
    }

    /**
     * This method will not return Friendship models
     * It will return the 'friends' models. ex: App\User
     *
     * @param int $perPage Number
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFriendsOfFriends($perPage = 0)
    {
        return $this->getOrPaginate($this->friendsOfFriendsQueryBuilder(), $perPage);
    }


    /**
     * Get the number of friends
     *
     * @param string $groupSlug
     *
     * @return integer
     */
    public function getFriendsCount($groupSlug = '')
    {
        $friendsCount = $this->findFriendships(Status::ACCEPTED, $groupSlug)->count();
        return $friendsCount;
    }

    /**
     * @param Model $recipient
     *
     * @return bool
     */
    public function canBefriend($recipient)
    {
        if ($this->hasBlocked($recipient)) {
            $this->unblockFriend($recipient);
            return true;
        }

        if ($friendship = $this->getFriendship($recipient)) {
            if ($friendship->status != Status::DENIED) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param Model $recipient
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function findFriendship(Model $recipient)
    {
        return Friendship::betweenModels($this, $recipient);
    }

    /**
     * @param $status
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findFriendships($status = null, $groupSlug = '')
    {

        $query = Friendship::where(function ($query) {
            $query->where(function ($q) {
                $q->whereSender($this);
            })->orWhere(function ($q) {
                $q->whereRecipient($this);
            });
        })->whereGroup($this, $groupSlug);

        if (!is_null($status)) {
            $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Get the query builder of the 'friend' model
     *
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getFriendsQueryBuilder($groupSlug = '')
    {

        $friendships = $this->findFriendships(Status::ACCEPTED, $groupSlug)->get(['sender_id', 'recipient_id']);
        $recipients  = $friendships->pluck('recipient_id')->all();
        $senders     = $friendships->pluck('sender_id')->all();
        return $this->where('id', '!=', $this->getKey())->whereIn('id', array_merge($recipients, $senders));
    }

    private function getFriendsSearchQueryBuilder($search = '')
    {

        $friendships = $this->findFriendships(Status::ACCEPTED)->get(['sender_id', 'recipient_id']);
        $recipients  = $friendships->pluck('recipient_id')->all();
        $senders     = $friendships->pluck('sender_id')->all();

        return $this->where('id', '!=', $this->getKey())
            ->whereIn('id', array_merge($recipients, $senders))
            ->where(function ($query) use ($search) {
                $query->where('username','LIKE','%'.$search.'%')
                ->orWhere('email','LIKE','%'.$search.'%')
                ->orWhere('first_name','LIKE','%'.$search.'%')
                ->orWhere('last_name','LIKE','%'.$search.'%');
            });
            
    }

    private function getReqQueryBuilder($groupSlug = '')
    {

        $friendships = $this->findFriendships(Status::PENDING, $groupSlug)->get(['sender_id', 'recipient_id']);
        $recipients  = $friendships->pluck('recipient_id')->all();
        $senders     = $friendships->pluck('sender_id')->all();
        return $this->where('id', '!=', $this->getKey())->whereIn('id', array_merge($senders));
    }

    /**
     * Get the query builder of the 'friend' model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function getMutualFriendsQueryBuilder(Model $other)
    {
        $user1['friendships'] = $this->findFriendships(Status::ACCEPTED)->get(['sender_id', 'recipient_id']);
        $user1['recipients'] = $user1['friendships']->pluck('recipient_id')->all();
        $user1['senders'] = $user1['friendships']->pluck('sender_id')->all();

        $user2['friendships'] = $other->findFriendships(Status::ACCEPTED)->get(['sender_id', 'recipient_id']);
        $user2['recipients'] = $user2['friendships']->pluck('recipient_id')->all();
        $user2['senders'] = $user2['friendships']->pluck('sender_id')->all();
        $mutualFriendships = array_unique(
            array_intersect(
                array_merge($user1['recipients'], $user1['senders']),
                array_merge($user2['recipients'], $user2['senders'])
            )
        );
        return $this->whereNotIn('id', [$this->getKey(), $other->getKey()])->whereIn('id', $mutualFriendships);
    }

    /**
     * Get the query builder for friendsOfFriends ('friend' model)
     *
     * @param string $groupSlug
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function friendsOfFriendsQueryBuilder($groupSlug = '')
    {
        $friendships = $this->findFriendships(Status::ACCEPTED)->get(['sender_id', 'recipient_id']);
        $recipients = $friendships->pluck('recipient_id')->all();
        $senders = $friendships->pluck('sender_id')->all();
        $friendIds = array_unique(array_merge($recipients, $senders));
        $fofs = Friendship::where('status', Status::ACCEPTED)
            ->where(function ($query) use ($friendIds) {
                $query->where(function ($q) use ($friendIds) {
                    $q->whereIn('sender_id', $friendIds);
                })->orWhere(function ($q) use ($friendIds) {
                    $q->whereIn('recipient_id', $friendIds);
                });
            })
            ->whereGroup($this, $groupSlug)
            ->get(['sender_id', 'recipient_id']);
        $fofIds = array_unique(
            array_merge($fofs->pluck('sender_id')->all(), $fofs->pluck('recipient_id')->all())
        );
        return $this->whereIn('id', $fofIds)->whereNotIn('id', $friendIds);
    }

    /**
     * @return MorphMany
     */
    public function friends()
    {
        return $this->morphMany(Friendship::class, 'sender');
    }

    protected function getOrPaginate($builder, $perPage)
    {
        if ($perPage == 0) {
            return $builder->get();
        }
        return $builder->paginate($perPage);
    }

    /**
     * Get blocked friends.
     *
     * @param int $resultsPerPage
     * @param string $paginateType
     * @return LengthAwarePaginator|Paginator|Collection
     * @throws Exception
     */
    public function blockedFriends($resultsPerPage = 0, $paginateType = 'default')
    {
        return PaginateRepository::resolvePaginator($this->scopedStatusQuery(Status::BLOCKED), $resultsPerPage, $paginateType);
    }

    /**
     * Get accepted friends
     *
     * @param int $resultsPerPage
     * @param string $paginateType
     * @return LengthAwarePaginator|Paginator|Collection
     * @throws Exception
     */
    public function acceptedFriends($resultsPerPage = 0, $paginateType = 'default')
    {
        return PaginateRepository::resolvePaginator($this->scopedStatusQuery(Status::ACCEPTED), $resultsPerPage, $paginateType);
    }

    /**
     * Get denied friends
     *
     * @param int $resultsPerPage
     * @param string $paginateType
     * @return LengthAwarePaginator|Paginator|Collection
     * @throws Exception
     */
    public function deniedFriends($resultsPerPage = 0, $paginateType = 'default')
    {
        return PaginateRepository::resolvePaginator($this->scopedStatusQuery(Status::DENIED), $resultsPerPage, $paginateType);
    }


    /**
     * Get accepted friends
     *
     * @param int $resultsPerPage
     * @param string $paginateType
     * @return LengthAwarePaginator|Paginator|Collection
     * @throws Exception
     */
    public function pendingFriends($resultsPerPage = 0, $paginateType = 'default')
    {
        return PaginateRepository::resolvePaginator($this->scopedStatusQuery(Status::PENDING), $resultsPerPage, $paginateType);
    }

    /**
     * Get scoped query builder based on status.
     *
     * @param $status
     * @return MorphMany
     * @throws Exception
     */
    public function scopedStatusQuery($status)
    {
        if (!in_array($status, [
            Status::ACCEPTED,
            Status::DENIED,
            Status::BLOCKED,
            Status::PENDING
        ])) {
            throw new Exception("Status parameter isn't a valid status type.");
        }
        return $this->friends()->where('status', $status);
    }
}