<?php

namespace App\Events;

use App\Models\Comment\GeneralComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewGeneralComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GeneralComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('generalblog'.$this->comment->blog_id);
    }

    public function broadcastWith()
        {
            return [
                'commentcount' => GeneralComment::where('blog_id',$this->comment->blog_id)->count(),
                'body' => $this->comment->body,
                'created_at' => $this->comment->created_at,
                'user' => [
                    'username' => $this->comment->user->username,
                    'photo' => $this->comment->user->photo,

                ],
            ];
        }
}
