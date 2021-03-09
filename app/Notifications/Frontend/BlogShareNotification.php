<?php

namespace App\Notifications\Frontend;

use App\Models\Blogs\Blog;
use Illuminate\Bus\Queueable;
use App\Models\BlogShares\BlogShare;
use App\Models\GeneralBlogShares\GeneralBlogShare;
use App\Models\Comment\GeneralComment;
use App\Models\GeneralBlogs\GeneralBlog;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class BlogShareNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $blog_share;

    public function __construct(BlogShare $blog_share)
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
        $data = [];
        if($this->blog_share->blog_type == 'App\Models\Blogs\Blog') {
            $data = [
                // 'blog' => $this->blog_share,
                'blog_id' => $this->blog_share->id,
                'message' => $this->blog_share->owner->first_name.' '.$this->blog_share->owner->last_name.' shared your "'.$this->blog_share->blog->name.'" blog',
            ];
        } else if($this->blog_share->blog_type == 'App\Models\GeneralBlogs\GeneralBlog') {
            $data = [
                // 'blog' => $this->blog_share,
                'blog_id' => $this->blog_share->id,
                'message' => $this->blog_share->owner->first_name.' '.$this->blog_share->owner->last_name.' shared your "'.$this->blog_share->general_blog->name.'" blog',
            ];
        }
        return $data;
    }

    public function toBroadcast($notifiable)
    {
        if($this->blog_share->blog_type == 'App\Models\Blogs\Blog') {
            return new BroadcastMessage([
                // 'blog' => $this->blog_share,
                'blog_id' => $this->blog_share->id,
                'message' => $this->blog_share->owner->first_name.' '.$this->blog_share->owner->last_name.' shared your "'.$this->blog_share->blog->name.'" blog',
            ]);
        } else if($this->blog_share->blog_type == 'App\Models\GeneralBlogs\GeneralBlog') {
            return new BroadcastMessage([
                // 'blog' => $this->blog_share,
                'blog_id' => $this->blog_share->id,
                'message' => $this->blog_share->owner->first_name.' '.$this->blog_share->owner->last_name.' shared your "'.$this->blog_share->general_blog->name.'" blog',
            ]);
        }
        
    }
    public function broadcastType()
    {
        return 'blogshare';
    }
}
