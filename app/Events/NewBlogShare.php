<?php

namespace App\Events;

use App\Models\BlogShares\BlogShare;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewBlogShare implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $blog_share;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BlogShare $blog_share)
    {
        $this->blog_share = $blog_share;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('blogsharecount'.$this->blog_share->blog_id);
    }

    public function broadcastWith()
    {
        return [
            'sharecount' => BlogShare::where('blog_id',$this->blog_share->blog_id),
        ];
    }
}
