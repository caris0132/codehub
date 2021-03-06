<?php
// khong type
$config_type[0] = [];

//  san-pham
$config_type['san-pham']['product'] = [
    'title_main' => 'Sản phẩm',
    'noidung' => true,
    'mota' => true,
    'seo' => true,
    'list' => true,
    'cat' => false,
    'item' => false,
    'sub' => false,
    'giaban' => true,
    'giacu' => true,
    'copy' => true,
    'view' => true,
    'slug' => true,
    'image' => [
        'enable' => true,
        'folder' => UPLOAD_PRODUCT,
        'width' => 300,
        'height' => 300,
        'style' => 1,
        'ratio' => 2,
        'mine_type' => MINE_TYPE_IMAGE,
    ],
    'gallery' => [
        'enable' => true,
        'folder' => UPLOAD_PRODUCT,
        'width' => 300,
        'height' => 300,
        'style' => 1,
        'ratio' => 2,
        'mine_type' => implode('|', [MINE_TYPE_IMAGE, MINE_TYPE_VIDEO, MINE_TYPE_OFFICE]),
    ],
    'check' => [
        'hienthi' => 'Hiển thị',
        'noibat' => 'Nổi bật',
    ]
];
$config_type['san-pham']['product_list'] = [
    'title_main' => 'Danh mục cấp 1',
    'noidung' => true,
    'mota' => true,
    'seo' => true,
    'images' => [
        'folder' => UPLOAD_PRODUCT,
        'width' => 300,
        'height' => 300,
        'type' => 300,
        'style' => 1,
        'ratio' => 2,
    ],
    'check' => [
        'hienthi' => 'Hiển thị',
        'noibat' => 'Nổi bật',
    ]
];

$config_type['san-pham']['product_cat'] = [
    'title_main' => 'Danh mục cấp 2',
    'noidung' => true,
    'mota' => true,
    'seo' => true,
    'images' => [
        'folder' => UPLOAD_PRODUCT,
        'width' => 300,
        'height' => 300,
        'type' => 300,
        'style' => 1,
        'ratio' => 2,
    ],
    'check' => [
        'hienthi' => 'Hiển thị',
        'noibat' => 'Nổi bật',
    ]
];

