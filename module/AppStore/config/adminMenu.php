<?php

return [
    [
        "label"     => "appStore",
        "path"      => "/admin/app/store",
        "component" => "basic",
        "name"      => "app.store",
        "hidden"    => false,
        "redirect"  => "noRedirect",
        "meta"      => [
            "title" => "应用商店",
            "icon"  => "el-icon-files",
            "roles" => [
                'admin'
            ],
        ],
        "children"  => [
            [
                "label"     => "appStore",
                "path"      => "/admin/app/store",
                "component" => "app_store",
                "name"      => "appStore",
                "hidden"    => false,
                "redirect"  => "",
                "meta"      => [
                    "title" => "应用商店",
                    "icon"  => "el-icon-house",
                    "roles" => [
                        1
                    ],
                ],

            ],
        ],

    ],
];
