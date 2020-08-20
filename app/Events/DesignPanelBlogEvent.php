<?php

namespace App\Events;

use App\Models\Like\Like;
use App\Models\Blogs\Blog;
use App\Models\Comment\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\BlogDesignPanels\BlogDesignPanel;
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
    public function __construct(Blog $saved_blog)
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
                'id'                => $this->saved_blog->id,
                'name'              => $this->saved_blog->name,
                'featured_image'    => $this->saved_blog->featured_image,
                'publish_datetime'  => is_null($this->saved_blog->publish_datetime)?$this->saved_blog->publish_datetime:$this->saved_blog->publish_datetime->format('d/m/Y h:i A'),
                'status'            => $this->saved_blog->status,
                'created_at'        => optional($this->saved_blog->created_at)->toDateString(),
                'created_by'        => (is_null($this->saved_blog->user_name)) ? optional($this->saved_blog->owner)->first_name : $this->saved_blog->user_name,
                'thumb'             => ($this->saved_blog->featured_image=='') ? '/storage/img/blog/default.png' : '/storage/img/blog/'.$this->saved_blog->featured_image,
                'hotcount'          => Like::where('blog_id',$this->saved_blog->id)->where('emotion',0)->count(),
                'coolcount'          => Like::where('blog_id',$this->saved_blog->id)->where('emotion',1)->count(),
                // 'naffcount'          => Like::where('blog_id',$this->saved_blog->id)->where('emotion',2)->count(),
                'commentcount'       => Comment::where('blog_id',$this->saved_blog->id)->count(),
                // 'blog_tag'           => $this->saved_blog->btags(),
            ];
        
}
}