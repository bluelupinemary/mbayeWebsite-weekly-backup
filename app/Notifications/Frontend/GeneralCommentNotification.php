<?php

namespace App\Notifications\Frontend;

use Illuminate\Bus\Queueable;
use App\Models\Comment\GeneralComment;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class GeneralCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $comment;

    public function __construct(GeneralComment $comment)
    {
        $this->comment = $comment;
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
                'blog_id' => $this->comment->blog_id,
                'author_id' => $this->comment->user_id,
                'author_first_name' => $this->comment->user->first_name,
                'author_last_name' => $this->comment->user->last_name,
                'comment_id' => $this->comment->id,
                'comment_body' => $this->comment->body,
                'comment_commented_at' => $this->comment->created_at,
                'message' => $this->comment->user->first_name.' '.$this->comment->user->last_name.' commented on your "'.$this->comment->blog->name.'" story',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'blog_id' => $this->comment->blog_id,
            'author_id' => $this->comment->user_id,
            'author_first_name' => $this->comment->user->first_name,
            'author_last_name' => $this->comment->user->last_name,
            'comment_id' => $this->comment->id,
            'comment_body' => $this->comment->body,
            'comment_commented_at' => $this->comment->created_at,
            'message' => $this->comment->user->first_name.' '.$this->comment->user->last_name.' commented on your "'.$this->comment->blog->name.'" story',
        ]);
    }
    public function broadcastType()
    {
        return 'new-comment';
    }
}
