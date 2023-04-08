<?php

return [
    [
        "label"     => "blog",
        "path"      => "/admin/blog/navigation",
        "component" => "basic",
        "name"      => "blog.navigation",
        "hidden"    => false,
        "redirect"  => "noRedirect",
        "meta"      => [
            "title" => "物料管理",
            "icon"  => "el-icon-files",
            "roles" => [
                'admin'
            ],
        ],
        "children"  => [
            [
                "label"     => "blog",
                "path"      => "/admin/blog/navigation",
                "component" => "navigation",
                "name"      => "blog.navigation.index",
                "hidden"    => false,
                "redirect"  => "",
                "meta"      => [
                    "title" => "导航菜单",
                    "icon"  => "el-icon-position",
                    "roles" => [
                        'admin'
                    ],
                ],
                "children"  => [

                ],
            ],
            [
                "label"     => "blog",
                "path"      => "/admin/blog/category",
                "component" => "category",
                "name"      => "blog.category.index",
                "hidden"    => false,
                "redirect"  => "",
                "meta"      => [
                    "title" => "分类管理",
                    "icon"  => "el-icon-s-operation",
                    "roles" => [
                        'admin'
                    ],
                ],
                "children"  => [

                ],
            ]
        ],

    ]
];
