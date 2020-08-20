<?php

namespace App\Notifications\Frontend;

use App\Models\Like\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ReactionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }

    public function toDatabase($notifiable)
    {
        return [
                'blog_id' => $this->like->blog_id,
                'blog_name' => $this->like->blog->name,
                'author_id' => $this->like->user_id,
                'author_first_name' => $this->like->user->first_name,
                'author_last_name' => $this->like->user->last_name,
                'emotion' => $this->like->emotion,
                'blog_name' => $this->like->blog->name,
                'message' => $this->like->user->first_name." give reaction on ".$this->like->blog->name,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'blog_id' => $this->like->blog_id,
            'blog_name' => $this->like->blog->name,
            'author_id' => $this->like->user_id,
            'author_first_name' => $this->like->user->first_name,
            'author_last_name' => $this->like->user->last_name,
            'emotion' => $this->like->emotion,
            'blog_name' => $this->like->blog->name,
            'message' => $this->like->user->first_name." give reaction on ".$this->like->blog->name,

        ]);
    }
    public function broadcastType()
    {
        return 'new-reaction';
    }
}
