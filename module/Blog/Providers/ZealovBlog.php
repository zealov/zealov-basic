<?php


use Module\Blog\Models\Chunk;
use Module\Blog\Models\Navigation;

class ZealovBlog
{

    public static function navigation($label='home')
    {
        $parent_id = Navigation::where('label', $label)->value('id');
        return Navigation::getNavigationByParentId($parent_id);
    }

    public static function carousel($label='home',$chunk=''){
        $navigation_id = Navigation::where('label', $label)->value('id');
        $chunk_id = Chunk::query()->where('subject_type','Module\Blog\Models\Navigation')
            ->where('subject_id',$navigation_id)
            ->where('name',$chunk)
            ->value('id');

    }

}
