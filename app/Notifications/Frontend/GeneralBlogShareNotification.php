<?php

namespace App\Notifications\Frontend;

use App\Models\BlogShares\BlogShare;
use App\Models\GeneralBlogShares\GeneralBlogShare;
use Illuminate\Bus\Queueable;
use App\Models\Comment\GeneralComment;
use App\Models\GeneralBlogs\GeneralBlog;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class GeneralBlogShareNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $blog_share;

    public function __construct(GeneralBlogShare $blog_share)
    {
        $this->blog_share = $blog_share;
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
                'blog' => $this->blog_share,
                'message' => $this->blog_share->owner->first_name.' '.$this->blog_share->owner->last_name.' shared your "'.$this->blog_share->blog->name.'" story',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'blog' => $this->blog_share,
            'message' => $this->blog_share->owner->first_name.' '.$this->blog_share->owner->last_name.' shared your "'.$this->blog_share->blog->name.'" story',
        ]);
    }
    public function broadcastType()
    {
        return 'generalblogshare';
    }
}
