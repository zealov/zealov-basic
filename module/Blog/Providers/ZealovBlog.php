<?php

use Illuminate\Support\Facades\DB;
use Module\Blog\Models\Category;
use Module\Blog\Models\Chunk;
use Module\Blog\Models\Model;
use Module\Blog\Models\Navigation;
use Module\Blog\Models\Post;
use Module\Blog\Models\Relationship;

class ZealovBlog
{

    public static function navigation($label = 'home')
    {
        $parent_id = Navigation::where('label', $label)->value('id');
        return Navigation::getNavigationByParentId($parent_id);
    }

    public static function post($offset = 1, $limit = 15, $categoryName = '')
    {
        $model = Post::query()->where('published', 1);
        if ($categoryName) {
            $categoryId = Category::where('name', $categoryName)->value('id');
            $model->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('relationship_id', $categoryId);
            });
        } else {
            $model->with('categories');
        }
        return $model->orderByDesc('created_at')
            ->skip(($offset - 1) * $limit)
            ->take($limit)
            ->get()
            ->toArray();
    }

    public static function postDetail($id,$field)
    {
        return  Post::query()->where('published', 1)->where('id',$id)->value($field);
    }

    public static function postDetailNext($id,$field)
    {
        return  Post::query()->where('published', 1)->where('id','>',$id)->value($field);
    }

    public static function postDetailPrev($id,$field)
    {
        return  Post::query()->where('published', 1)->where('id','<',$id)->value($field);
    }

    public static function inRandomOrder($limit, $categoryName = '')
    {
        $model = Post::query()->where('published', 1);
        if ($categoryName) {
            $categoryId = Category::where('name', $categoryName)->value('id');
            $model->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('relationship_id', $categoryId);
            });
        } else {
            $model->with('categories');
        }
        $data = $model->inRandomOrder()
            ->take($limit)
            ->get()
            ->toArray();

        return $data;
    }

    public static function categoryName($categoryName)
    {
        if (is_null($categoryName)) {
            return '最新文章';
        }
        if (Category::where('name', $categoryName)->value('id')) {
            return $categoryName;
        }
        return '最新文章';
    }

    public static function page($url = '',$field){
        $navigation_id = Navigation::where('url', $url)->value('id');
        $chunk = Chunk::query()->where('subject_type', 'Module\Blog\Models\Navigation')
            ->where('subject_id', $navigation_id)
            ->where('type', 'pages')
            ->first();
        $subject_type = 'chunks';
        $tableMap = Model::tableMap;
        $subject_id = $chunk->id;
        $type = $chunk->type;
        $subject_type_model = $tableMap[$subject_type]['model'];
        //查询关联内容
        return  Relationship::query()->join($tableMap[$type]['table'], 'relationship.relationship_id', $tableMap[$type]['table'] . '.id')
            ->where('relationship.subject_type', $subject_type_model)
            ->where('relationship.subject_id', $subject_id)
            ->value($field);
    }



    public static function relationship($label = 'index', $chunk_name = '', $offset = 0, $limit = 15)
    {
        $navigation_id = Navigation::where('label', $label)->value('id');

        $chunk = Chunk::query()->where('subject_type', 'Module\Blog\Models\Navigation')
            ->where('subject_id', $navigation_id)
            ->where('name', $chunk_name)
            ->first();
        $subject_type = 'chunks';
        $tableMap = Model::tableMap;
        if (empty($chunk)) {
            return [];
        }
        $subject_id = $chunk->id;
        $type = $chunk->type;
        $subject_type_model = $tableMap[$subject_type]['model'];
        $default_mode = 'Module\Blog\Models\Category';
        $target_model = $tableMap[$type]['model'];
        //获取相关绑定分类
        $relationship_ids = Relationship::where('subject_type', $subject_type_model)
            ->where('subject_id', $subject_id)
            ->where('relationship_type', $default_mode)
            ->pluck('relationship_id')
            ->toArray();

        //查询关联内容
        $model = Relationship::query()
            ->when($relationship_ids, function ($query) use (
                $tableMap,
                $type,
                $target_model,
                $relationship_ids
            ) {
                $query->join($tableMap[$type]['table'], 'relationship.subject_id', $tableMap[$type]['table'] . '.id')
                    ->where('relationship.subject_type', $target_model)
                    ->whereIn('relationship.relationship_id', $relationship_ids)
                    ->groupBy('relationship.subject_id');
            })->when(empty($relationship_ids), function ($query) use (
                $tableMap,
                $type,
                $target_model,
                $relationship_ids,
                $subject_type_model,
                $subject_id
            ) {
                $query->join($tableMap[$type]['table'], 'relationship.relationship_id', $tableMap[$type]['table'] . '.id')
                    ->where('relationship.subject_type', $subject_type_model)
                    ->where('relationship.subject_id', $subject_id)
                    ->groupBy('relationship.relationship_id');
            });
        if (!$offset) {
            $data = $model
                ->orderByDesc($tableMap[$type]['table'] . '.created_at')
                ->get()
                ->toArray();
        } else {
            $data = $model
                ->orderByDesc($tableMap[$type]['table'] . '.created_at')
                ->skip(($offset - 1) * $limit)
                ->take($limit)
                ->get()
                ->toArray();
        }
        return $data;
    }

}
