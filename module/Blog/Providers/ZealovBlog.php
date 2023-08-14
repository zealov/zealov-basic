<?php


use Module\Blog\Models\Navigation;

class ZealovBlog
{

    public static function navigation()
    {
        $parent_id = Navigation::where('label', 'home')->value('id');
        return Navigation::getNavigationByParentId($parent_id);
    }


}
