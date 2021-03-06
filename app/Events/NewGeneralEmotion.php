<?php

namespace App\Events;

use App\Models\Like\GeneralLike;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewGeneralEmotion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $like;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GeneralLike $like)
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
        return new Channel('generalblogLike'.$this->like->blog_id);
    }

    public function broadcastWith()
        {
            return [
                'hotcount' => GeneralLike::where('blog_id',$this->like->blog_id)->where('emotion',0)->count(),
                'coolcount' => GeneralLike::where('blog_id',$this->like->blog_id)->where('emotion',1)->count(),
                'naffcount' => GeneralLike::where('blog_id',$this->like->blog_id)->where('emotion',2)->count(),
            ];
        }
}
