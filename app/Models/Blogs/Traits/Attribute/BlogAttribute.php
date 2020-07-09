<?php

namespace App\Models\Blogs\Traits\Attribute;

use Illuminate\Support\Str;
use Auth;
/**
 * Class BlogAttribute.
 */
trait BlogAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">'.
                $this->getEditButtonAttribute('edit-blog', 'admin.blogs.edit').
                $this->getDeleteButtonAttribute('delete-blog', 'admin.blogs.destroy').
                '</div>';
    }

    public function isDesignsBlog()
    {
        $panel_design = $this->blog_panel_design;

        if($panel_design) {
            return true;
        } else {
            return false;
        }
    }

    public function getContentSummary()
    {
        $excerpt_content = Str::limit(strip_tags(preg_replace('#(<span[^>]*>).*?(</span>)#', '$1$2', $this->content)), 200);
        
        return $excerpt_content;
    }

    public function getFeaturedImage()
    {
        $featured_image = 'blog-default-featured-image.png';
        if($this->featured_image != null) {
            $featured_image = $this->featured_image;
        }

        return $featured_image;
    }

    public function getTitle()
    {
        return Str::limit($this->name, 20);
    }

    public function getReaction($emotion_id)
    {
        if($emotion_id == 0) {
            return 'hot';
        } else if($emotion_id == 1) {
            return 'cool';
        } else if($emotion_id == 2) {
            return 'naff';
        }
    }

    public function getUserReaction()
    {
        $like = $this->likes->where('user_id', Auth::user()->id)->first();

        $reaction = '';
        if($like) {
            $reaction = $this->getReaction($like->emotion);
        }

        return $reaction;
    }

    public function getFirstTwoTags()
    {
        $tags = $this->tags->take(2);
        return $tags;
    }

    public function btags()
    {
        $tags = $this->tags->pluck('name');
        return $tags;
    }

    public function remainingTagCount()
    {
        $tag_count = $this->tags->count();
        $remaining_tag_count = $tag_count - 2;

        return $remaining_tag_count;
    }

    public function filterVideoLinks()
    {
        $videos = $this->videos;
        $valid_videos = [];
        $invalid_videos = [];

        foreach($videos as $video) {
            if (preg_match ("/\b(?:vimeo|youtube|dailymotion)\.com\b/i", $video->videourl)) {
                $valid_videos[] = $video->videourl;
            } else {
                $invalid_videos[] = $video->videourl;
            }
        }

        return array('valid_videos' => $valid_videos, 'invalid_videos' => $invalid_videos);
    }

    public function getNaffFartStatus()
    {
        $naff_count = $this->likes->where('emotion', 2)->count();

        if($naff_count >= 555) {
            return true;
        } else {
            return false;
        }        
    }
}
