<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Const
    |--------------------------------------------------------------------------
    */

    // 0:仮登録 1:本登録 2:メール認証済 9:退会済
    'USER_STATUS' => [
      'PRE_REGISTER' => '0',
      'REGISTER' => '1',
      'MAIL_AUTHED' => '2',
      'PRE_CONTRIBUTOR' => '10',
      'CONTRIBUTOR' => '11',
      'PRE_AUDIENCE' => '20',
      'AUDIENCE' => '21',
      'DEACTIVE' => '99',
      'ADMIN' => '100'
    ],


];
