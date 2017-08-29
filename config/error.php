<?php
/**
 * Created by PhpStorm.
 * User: luna
 * Date: 2017/8/28
 * Time: 14:27
 */

$CATEGORY_STATE = 0x10000;



return [
    'code' => [
        'success' => 0,
        'cate' => [
            'update_fail' => $CATEGORY_STATE + 0x10,
            'delete_fail' => $CATEGORY_STATE + 0x20,
            'cannot_delete_root' => $CATEGORY_STATE + 0x21,
        ],
    ],
    'info' => [
        'success' => 'success',
    ],
];