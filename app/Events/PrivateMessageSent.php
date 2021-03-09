<?php

namespace App\Events;

use App\Models\Messages\Conversation;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PrivateMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $conversation = Conversation::find($this->message->conversation_id);
        if(Auth::id() == $conversation->user1_id)
        return new PrivateChannel('privatechat.'.$conversation->user2_id);
        else
        return new PrivateChannel('privatechat.'.$conversation->user1_id);

    }
}
