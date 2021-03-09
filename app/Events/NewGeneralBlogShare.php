<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\GeneralBlogShares\GeneralBlogShare;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewGeneralBlogShare implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $blog_share;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GeneralBlogShare $blog_share)
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
        return new Channel('generalblogsharecount'.$this->blog_share->blog_id);
    }

    public function broadcastWith()
    {
        return [
            'sharecount' => GeneralBlogShare::where('blog_id',$this->blog_share->blog_id),
        ];
    }
}
