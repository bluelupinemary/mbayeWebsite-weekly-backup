<?php

namespace App\Models\Blogs\Traits\Attribute;

use Illuminate\Support\Str;
use App\Models\Friendships\Group;
use Illuminate\Support\Facades\Auth;
use App\Models\BlogPrivacy\BlogPrivacy;
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
                $this->getShowButtonAttribute('delete-blog', 'admin.blogs.show').
                '</div>';
    }

    public function getTrashedButtonsAttribute()
    {
            return '<div class="btn-group action-btn">
                        '.$this->getRestoreButtonAttribute('btn btn-default btn-flat').'
                        '.$this->getDeletePermanentlyButtonAttribute('btn btn-default btn-flat').'
                    </div>';
    }

    public function getRestoreButtonAttribute($class)
    {
        if (access()->allow('delete-user')) {
            return '<a class="'.$class.'" href="'.route('admin.blog.restore', $this).'" name="restore_blog"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.restore_user').'"></i></a> ';
        }
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute($class)
    {
        return '<a class="'.$class.'" href="'.route('admin.blog.delete-permanently', $this).'" name="delete_blog_perm"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.delete_permanently').'"></i></a> ';
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

    public function isCareerBlog()
    {
        $career_tag = $this->tags->where('id', 9)->count();
        
        if($career_tag) {
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

    public function tags_code()
    {
        $tags = $this->tags->pluck('code');
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

    public function getEditURL()
    {
        if($this->isDesignsBlog()) {
            $url = url('/communicator?action=edit_design_blog&blog_id='.$this->id.'&section=designs_blog');
        } else if ($this->isCareerBlog()) {
            $url = url('/communicator?action=edit_career_blog&blog_id='.$this->id.'&section=career_blog');
        } else {
            $url = url('/communicator?action=edit_blog&blog_id='.$this->id.'&section=blog');
        }

        return $url;
    }

    public function mostReaction()
    {
        $hotness = $this->likes->where('emotion', 0)->count();
        $coolness = $this->likes->where('emotion', 1)->count();
        $naffness = $this->likes->where('emotion', 2)->count();
       
        if($hotness || $coolness || $naffness) {
            if(($hotness == $coolness) && ( $coolness == $naffness)) {
                $most = '';
            } else {
                if($hotness > $coolness && $hotness > $naffness){
                    $most = 'hotness';
                } else if($coolness > $hotness && $coolness > $naffness){
                    $most = 'coolness';
                } else if($naffness > $hotness && $naffness > $coolness){
                    $most = 'naffness';
                } else if($hotness == $coolness) {
                    $latest_reaction = $this->likes->whereIn('emotion', [0,1])->sortByDesc('created_at')->first();

                    if($latest_reaction->emotion == 0) {
                        $most = 'hotness';
                    } else if($latest_reaction->emotion == 1) {
                        $most = 'coolness';
                    }
                } else if($hotness == $naffness) {
                    $latest_reaction = $this->likes->whereIn('emotion', [0,2])->sortByDesc('created_at')->first();

                    if($latest_reaction->emotion == 0) {
                        $most = 'hotness';
                    } else if($latest_reaction->emotion == 2) {
                        $most = 'naffness';
                    }
                } else if($coolness == $naffness) {
                    $latest_reaction = $this->likes->whereIn('emotion', [1,2])->sortByDesc('created_at')->first();

                    if($latest_reaction->emotion == 1) {
                        $most = 'coolness';
                    } else if($latest_reaction->emotion == 2) {
                        $most = 'naffness';
                    }
                }
            }
        } else {
            $most = '';
        }
        
        return $most;
    }

    public function getgroups(){
        $group = $this->privacy->pluck('group_id');
        $group_names = Group::whereIn('id',$group)->take(2)->pluck('name')->implode(',');
        $group_count = Group::whereIn('id',$group)->count();
        $remaining_count = $group_count-2;
        if($group->count() == 0){
            $groups = null;
            return $groups;
        }
        else{
            if($remaining_count > 0){
            $groups = $group_names." + ".$remaining_count." more ";
            return $groups;
        }else{
            $groups = $group_names;
            return $groups;
        }
        }
    }
}
