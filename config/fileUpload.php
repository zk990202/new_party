<?php
/**
 * Created by PhpStorm.
 * User: liebes
 * Date: 2017/7/10
 * Time: 下午3:42
 */

$imageExtensions = [
    'png', 'jpeg', 'jpg', 'bmp'
];
$videoExtensions = [
    'mp4', 'avi', 'wmv', 'png', 'jpeg', 'gif', 'jpg', 'bmp', 'mov'
];
$fileExtensions = [
    'zip', 'rar', 'tar', 'tar.gz', 'tar.bz2'
];

return [
    'max_size' => 1024 * 1024 * 5,  // default 5MB
    'rules' => [
        'noticeImg' => [
            'path' => 'images/notification',
            'extensions' => $imageExtensions,
            'disk' => 'public'
        ],
        'noticeFile' => [
            'path' => 'files/notification',
            'extensions' => $fileExtensions,
            'disk' => 'public'
        ],
        'partyBuildImg' => [
            'path' => 'images/partyBuild',
            'extensions' => $imageExtensions,
            'disk' => 'public'
        ]
    ]
];

