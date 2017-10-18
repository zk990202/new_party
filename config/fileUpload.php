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
    'zip', 'rar', 'tar', 'tar.gz', 'tar.bz2', 'doc', 'docx'
];
$eBookExtensions = [
    'txt', 'chm', 'pdf', 'epub'
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
        ],
        'importantFilesFile' => [
            'path' => 'files/importantFiles',
            'extensions' => $fileExtensions,
            'disk' => 'public'
        ],
        'importantFilesImg' => [
            'path' => 'images/importantFiles',
            'extensions' => $imageExtensions,
            'disk' => 'public'
        ],
        'theoryStudyVideo' => [
            'path' => 'videos/theoryStudy',
            'extensions' => $videoExtensions,
            'disk' => 'public',
            'max_size' => 1024 * 1024 * 60
        ],
        'theoryStudyEBook' => [
            'path' => 'eBook/theoryStudy',
            'extensions' => $eBookExtensions,
            'disk' => 'public'
        ],
        'applicantFile' => [
            'path' => 'files/applicant',
            'extensions' => $fileExtensions,
            'disk' => 'public'
        ],
        'probationaryImg' => [
            'path' => 'images/probationary',
            'extensions' => $imageExtensions,
            'disk' => 'public'
        ],
        'probationaryFile' => [
            'path' => 'files/probationary',
            'extensions' => $fileExtensions,
            'disk' => 'public'
        ]
    ]
];

