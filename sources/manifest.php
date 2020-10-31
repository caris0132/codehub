<?php

$manifest_default = [
    'name' => 'ten App dai',
    'short_name' => 'ten app ngan',
    'description' => 'mota app',
    'icons' => [
        [
            "src" => "thumb/512x515/2/assets/images/logo.png",
            "type" => "image/png",
            "sizes" => "512x512",
        ],
        [
            "src" => "thumb/256x256/2/assets/images/logo.png",
            "type" => "image/png",
            "sizes" => "256x256",
        ],
        [
            "src" => "thumb/192x192/2/assets/images/logo.png",
            "type" => "image/png",
            "sizes" => "192x192",
        ],
    ],
    "start_url" => "/codehub/",
    "scope" => "/codehub/",
    "dir" => "ltr",
    "background_color" => "#111111",
    "display" => "standalone",
    "theme_color" => "#111111",
    "orientation" => "portrait",
    "prefer_related_applications" => false
];

$manifest_custom = [];

echo json_encode(array_merge($manifest_default, $manifest_custom));
