<?php
return [
    [
        "label"     => "sys",
        "path"      => "/admin/login",
        "component" => "default",
        "name"      => "login",
        "meta"      => [
            "title" => "登录",
            "icon"  => "el-icon-files",
            "roles" => [
                1
            ],
        ],
        "children"  => [
            [
                "label"     => "sys",
                "path"      => "/admin/login",
                "component" => "login",
                "name"      => "admin.login",
                "meta"      => [
                    "title" => "登录",
                    "icon"  => "el-icon-files",
                    "roles" => [
                        1
                    ],
                ],
                "children"  => [

                ],
                "hidden"    => false,
                "redirect"  => "",
            ],
        ],
        "hidden"    => false,
        "redirect"  => "noRedirect",
    ],
    [
        "label"     => "sys",
        "path"      => "/admin/admin/index",
        "component" => "basic",
        "name"      => "admin12312312",
        "meta"      => [
            "title" => "项目管理",
            "icon"  => "el-icon-files",
            "roles" => [
                1
            ],
        ],
        "children"  => [
            [
                "label"     => "sys",
                "id"        => 50,
                "pid"       => 0,
                "path"      => "/admin/admin/index",
                "component" => "welcome1",
                "name"      => "admin123123",
                "meta"      => [
                    "title" => "测试项目管理",
                    "icon"  => "el-icon-files",
                    "roles" => [
                        1
                    ],
                ],
                "children"  => [

                ],
                "hidden"    => false,
                "redirect"  => "",
            ],
            [
                "label"     => "sys",
                "path"      => "/admin/admin/index2",
                "component" => "welcome2",
                "name"      => "admin12312322",
                "meta"      => [
                    "title" => "测试项目管理2",
                    "icon"  => "el-icon-files",
                    "roles" => [
                        1
                    ]
                ],
                "children"  => [

                ],
                "hidden"    => false,
                "redirect"  => "",
            ]
        ],
        "hidden"    => false,
        "redirect"  => "noRedirect",
    ],
];


?>
