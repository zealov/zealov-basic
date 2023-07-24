<?php

namespace Module\Blog\Models;


use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{

    const tableMap = [
        'posts' => [
            'table' => 'posts',
            'name'  => '文章',
            'model' => 'Module\Blog\Models\Post',
        ],
        'pages' => [
            'table' => 'pages',
            'name'  => '页面',
            'model' => 'Module\Blog\Models\Page',
        ],
        'navigations' => [
            'table' => 'pages',
            'name'  => '导航',
            'model' => 'Module\Blog\Models\Navigation',
        ],
        'categories' => [
            'table' => 'categories',
            'name'  => '分类',
            'model' => 'Module\Blog\Models\Category',
        ],
    ];
}