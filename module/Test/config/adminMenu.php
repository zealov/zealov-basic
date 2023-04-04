<?php

return [
    [
        "label"     => "blog",
        "path"      => "/admin/admin/project",
        "component" => "basic",
        "name"      => "project",
        "meta"      => [
            "title" => "项目管理项目管理",
            "icon"  => "el-icon-files",
            "roles" => [
                1
            ],
        ],
        "children"  => [
            [
                "label"     => "blog",
                "id"        => 50,
                "pid"       => 0,
                "path"      => "/admin/index",
                "component" => "home1",
                "name"      => "project.index",
                "meta"      => [
                    "title" => "项目列表",
                    "icon"  => "",
                    "roles" => [
                        1
                    ],
                ],
                "children"  => [

                ],
                "hidden"    => false,
                "redirect"  => "",
            ]
        ],
        "hidden"    => false,
        "redirect"  => "noRedirect",
    ]
];
