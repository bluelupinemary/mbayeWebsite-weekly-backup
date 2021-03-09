<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;
use App\Models\CareStories\CareStory;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewCareStoryEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $care_story;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CareStory $care_story)
    {
        $this->care_story = $care_story;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new_story');
    }

    public function broadcastWith()
        {
            return [
                'story' => $this->care_story,
            ];
        }
}
