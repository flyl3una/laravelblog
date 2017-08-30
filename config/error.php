<?php
/**
 * Created by PhpStorm.
 * User: luna
 * Date: 2017/8/28
 * Time: 14:27
 */

$CATEGORY_CODE = 0x10000;
$ARTICLE_CODE = 0x10100;


return [
    'code' => [
        'success' => 0,
        'cate' => [
            'update_fail' => $CATEGORY_CODE + 0x10,
            'delete_fail' => $CATEGORY_CODE + 0x20,
            'cannot_delete_root' => $CATEGORY_CODE + 0x21
        ],
        'article' => [
            'file_ext_error' => $ARTICLE_CODE + 0x11,
            'update_fail' => $ARTICLE_CODE + 0x10,
            'delete_fail' => $ARTICLE_CODE + 0x20,
            'cannot_delete_root' => $ARTICLE_CODE + 0x21
        ]
    ],
    'info' => [
        'success' => 'success'
    ]
];