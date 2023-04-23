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

    ],
    [
        "label"     => "blog",
        "path"      => "/admin/blog",
        "component" => "basic",
        "name"      => "blog.post",
        "hidden"    => false,
        "redirect"  => "noRedirect",
        "meta"      => [
            "title" => "博客管理",
            "icon"  => "el-icon-files",
            "roles" => [
                'admin'
            ],
        ],
        "children"  => [
            [
                "label"     => "blog",
                "path"      => "/admin/blog/post",
                "component" => "post/post_list",
                "name"      => "blog.post.index",
                "hidden"    => false,
                "redirect"  => "",
                "meta"      => [
                    "title" => "文章列表",
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
                "path"      => "/admin/blog/post_create",
                "component" => "post/post_create",
                "name"      => "blog.post.create",
                "hidden"    => true,
                "redirect"  => "",
                "meta"      => [
                    "title" => "创建文章",
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
                "path"      => "/admin/blog/post_edit/:id",
                "component" => "post/post_edit",
                "name"      => "blog.post.edit",
                "hidden"    => true,
                "redirect"  => "",
                "meta"      => [
                    "title" => "编辑文章",
                    "icon"  => "el-icon-position",
                    "roles" => [
                        'admin'
                    ],
                ],
                "children"  => [

                ],
            ]
        ],

    ],
    [
        "label"     => "blog",
        "path"      => "/admin/blog/site",
        "component" => "basic",
        "name"      => "blog.site",
        "hidden"    => false,
        "redirect"  => "noRedirect",
        "meta"      => [
            "title" => "系统设置",
            "icon"  => "el-icon-files",
            "roles" => [
                'admin'
            ],
        ],
        "children"  => [
            [
                "label"     => "blog",
                "path"      => "/admin/blog/siteConfig",
                "component" => "site_config",
                "name"      => "blog.site.index",
                "hidden"    => false,
                "redirect"  => "",
                "meta"      => [
                    "title" => "站点设置",
                    "icon"  => "el-icon-position",
                    "roles" => [
                        'admin'
                    ],
                ],
                "children"  => [

                ],
            ],
        ],
    ],
];
