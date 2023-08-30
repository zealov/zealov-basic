<?php

return [
    [
        "label"     => "appStore",
        "path"      => "/admin/app/store",
        "component" => "app_store",
        "name"      => "app.store",
        "hidden"    => true,
        "redirect"  => "",
        "meta"      => [
            "title" => "应用商店",
            "icon"  => "el-icon-files",
            "roles" => [
                'admin'
            ],
        ],
    ],
    [
        "label"     => "blog",
        "path"      => "/admin/iframe/store",
        "component" => "basic",
        "name"      => "blog.iframe",
        "hidden"    => false,
        "redirect"  => "",
        "meta"      => [
            "title" => "iframe",
            "icon"  => "el-icon-files",
            "roles" => [
                'admin'
            ],
        ],
        "children"  => [
            [
                "label"     => "blog",
                "path"      => "/admin/iframe/store",
                "component" => "iframe",
                "name"      => "blog.iframe.index",
                "hidden"    => false,
                "redirect"  => "",
                "meta"      => [
                    "title" => "应用商店",
                    "icon"  => "el-icon-s-operation",
                    "roles" => [
                        'admin'
                    ],
                    "iframe"=>"/admin/app/store"
                ],
            ]
        ],
    ],
];
