<?php

namespace App\Events\Backend\GeneralBlogs;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCreated.
 */
class GeneralBlogCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $blogs;

    /**
     * @param $blogs
     */
    public function __construct($blogs)
    {
        $this->blogs = $blogs;
    }
}
