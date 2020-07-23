<?php

namespace App\Events;

use App\Models\BlogDesignPanels\BlogDesignPanel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DesignPanelBlogEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $saved_blog;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BlogDesignPanel $saved_blog)
    {
        $this->saved_blog = $saved_blog;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('designpanel_blogs');
    }

    public function broadcastWith()
        {
            return [
                'test' => 'ok',
            ];
        }
}
