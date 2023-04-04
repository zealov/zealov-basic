<?php
return [
    [
        "label"     => "sys",
        "path"      => "/admin/home",
        "component" => "basic",
        "name"      => "home",
        "hidden"    => false,
        "redirect"  => "noRedirect",
        "meta"      => [
            "title" => "首页",
            "icon"  => "el-icon-house",
            "roles" => [
                1
            ],
        ],
        "children"  => [
            [
                "label"     => "sys",
                "path"      => "/admin/home",
                "component" => "home",
                "name"      => "admin.home",
                "hidden"    => false,
                "redirect"  => "",
                "meta"      => [
                    "title" => "首页",
                    "icon"  => "el-icon-house",
                    "roles" => [
                        1
                    ],
                ],

            ],
        ],
    ],
];


?>
