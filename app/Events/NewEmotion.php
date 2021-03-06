<?php

namespace App\Events;

use App\Models\Like\Like;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewEmotion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $like;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('blogLike'.$this->like->blog_id);
    }

    public function broadcastWith()
    {
        return [
            'hotcount' => Like::where('blog_id',$this->like->blog_id)->where('emotion',0)->count(),
            'coolcount' => Like::where('blog_id',$this->like->blog_id)->where('emotion',1)->count(),
            'naffcount' => Like::where('blog_id',$this->like->blog_id)->where('emotion',2)->count(),
        ];
    }
}
