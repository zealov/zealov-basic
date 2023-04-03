<?php
return [
    [
        "label"     => "sys",
        "path"      => "/admin/admin/index",
        "component" => "basic",
        "name"      => "adminindexccasda",
        "meta"      => [
            "title" => "项目管理1",
            "icon"  => "el-icon-files",
            "roles" => [
                1
            ],
        ],
        "children"  => [
            [
                "label"     => "sys",
                "path"      => "/admin/admin/index2",
                "component" => "welcome1",
                "name"      => "adminindex.adminindexsss",
                "meta"      => [
                    "title" => "测试项目管理",
                    "icon"  => "el-icon-files",
                    "roles" => [
                        1
                    ],
                ],
//                "children"  => [
//
//                ],
                "hidden"    => false,
                "redirect"  => "",
            ],
        ],
        "hidden"    => false,
        "redirect"  => "noRedirect",
    ],
    [
        "label"     => "sys",
        "path"      => "/admin/admin/index3",
        "component" => "basic",
        "name"      => "adminindex",
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
                "path"      => "/admin/admin/index3",
                "component" => "welcome",
                "name"      => "adminindex.adminindex",
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
        ],
        "hidden"    => false,
        "redirect"  => "noRedirect",
    ],
];


?>
