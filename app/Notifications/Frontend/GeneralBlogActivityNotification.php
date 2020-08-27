<?php

namespace App\Notifications\Frontend;

use App\Models\Blogs\Blog;
use App\Models\GeneralBlogs\GeneralBlog;
use App\Models\Like\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class GeneralBlogActivityNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $blog;

    public function __construct(GeneralBlog $blog)
    {
        $this->blog = $blog;
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
        return [
            'blog' => $this->blog,
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'blog' => $this->blog,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'blog' => $this->blog,
        ]);
    }
    public function broadcastType()
    {
        return 'new-GeneralblogActivity';
    }
}
