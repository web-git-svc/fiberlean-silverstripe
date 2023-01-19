<?php

namespace App\Extensions\Blog;

use App\Model\Elements\ElementLatestPosts;
use SilverStripe\Core\Extension;

class BlogCategoryExtension extends Extension
{
   private static $has_many = [
       'LatestPostsElement' => ElementLatestPosts::class,
   ];
}
