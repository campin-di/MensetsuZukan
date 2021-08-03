<?php

return [
    // 0:仮登録, 1:本登録, 2:メール認証済, 10:視聴不可, 11:視聴可, 99:退会済, 100:管理者
    'USER_STATUS' => [
        'PRE_REGISTER' => '0',
        'MAIL_AUTHED' => '2',
        'UNAVAILABLE' => '10',
        'AVAILABLE' => '11',
        'DEACTIVE' => '99',
        'ADMIN' => '100'
    ],
    'INTERVIEW' => [
        'UNAVAILABLE' => '0',
        'AVAILABLE' => '1',
        'UNSCORE' => '2',
        'DONE' => '-1',
    ],
    'TIME' => [
        'ZERO' => '0',
        'TO_HARF' => '1',
        'FROM_HARF' => '2',
        'BOTH' => '3',
    ],
    'STHR' => [
        'ST' => '0',
        'HR' => '1',
    ]
];
