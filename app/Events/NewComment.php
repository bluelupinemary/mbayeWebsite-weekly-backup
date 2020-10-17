<?php

namespace App\Events;

use App\Models\Comment\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
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
        return new Channel('blog'.$this->comment->blog_id);
    }

    public function broadcastWith()
        {
            return [
                'commentcount' => Comment::where('blog_id',$this->comment->blog_id)->count(),
                'body' => $this->comment->body,
                'created_at' => $this->comment->created_at,
                'user' => [
                    'username' => $this->comment->user->username,
                    'first_name' => $this->comment->user->first_name,
                    'last_name' => $this->comment->user->last_name,
                    'photo' => $this->comment->user->photo,
                    'gender' => $this->comment->user->gender,

                ],
            ];
        }
}
