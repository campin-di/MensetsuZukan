<?php

use Illuminate\Support\Facades\Route;

    //prefix('hr')は指定箇所のルートの先頭に'hr.'をつける

    //home to watch
    Route::get('/watch/{id}', 'Hr_WatchController@index')->name('hr.watch');

    //mypage to interviewDetails
    Route::get('/interview/pre/{id}', 'Hr_InterviewController@preStart')->name('hr.interview.preStart');

    /*=== スケジュール登録 関係 ===============================================*/
    //mypage to schedule adding function
    Route::get('/interview/schedule/add', 'Hr_ScheduleController@add')->name('hr.interview.schedule.add');

    //form to comfirm page
    Route::post('/interview/schedule/post', 'Hr_ScheduleController@post')->name('hr.interview.schedule.post');

    Route::get('/interview/schedule/confirm', "Hr_ScheduleController@confirm")->name('hr.interview.schedule.confirm');
    Route::post('/interview/schedule/confirm', "Hr_ScheduleController@send")->name('hr.interview.schedule.send');

    Route::get('/interview/schedule/thanks', "Hr_ScheduleController@complete")->name('hr.interview.schedule.complete');
    /*=== end:スケジュール登録 関係 ===============================================*/

    /*=== 質問リスト登録 関係 ===============================================*/
    //pre_start to question form
    Route::get('/interview/question/add/{id}', 'Hr_InterviewController@add')->name('hr.interview.question.add');

    //question form to comfirm page
    Route::post('/interview/question/post', 'Hr_InterviewController@post')->name('hr.interview.question.post');

    Route::get('/interview/question/confirm', "Hr_InterviewController@confirm")->name('hr.interview.question.confirm');
    Route::post('/interview/question/confirm', "Hr_InterviewController@send")->name('hr.interview.question.send');

    Route::get('/interview/question/thanks', "Hr_InterviewController@complete")->name('hr.interview.question.complete');
    /*=== end:質問リスト登録 関係 ===============================================*/

    /*=== 採点機能 関係 ===============================================*/
    //pre_start to scoring form
    Route::get('/interview/score/add/{id}', 'Hr_InterviewController@add')->name('hr.interview.question.add');

    //scoring form to comfirm page
    Route::post('/interview/score/post', 'Hr_InterviewController@post')->name('hr.interview.question.post');

    Route::get('/interview/score/confirm', "Hr_InterviewController@confirm")->name('hr.interview.question.confirm');
    Route::post('/interview/score/confirm', "Hr_InterviewController@send")->name('hr.interview.question.send');

    Route::get('/interview/score/thanks', "Hr_InterviewController@complete")->name('hr.interview.question.complete');
    /*=== end:採点機能 関係 ===============================================*/

    /*=== マイページ関係 =============================================================*/
    //to mypage
    Route::get('/mypage', 'Hr_HrMypageController@index')->name('hr.mypage');

    // mypage to detail Page
    Route::get('/mypage/detail', 'Hr_HrMypageController@myDetail')->name('hr.mypage.detail');

    // to hr theirPage
    Route::get('/hrMypage/theirPage/{id}', 'Hr_HrMypageController@theirPage')->name('hr.hr_theirPage');
    // from hr theirPage to detail
    Route::get('/hrMypage/theirPage/{id}/detail', 'Hr_HrMypageController@theirDetail')->name('hr.hr_theirPage.detail');

    /*--- 基本情報の変更 -------------------------*/
    Route::get('/mypage/edit/basic', "Hr_HrMypageBasicController@show")->name('hr.mypage.basic.show');
    Route::post('/mypage/edit/basic', "Hr_HrMypageBasicController@post")->name('hr.mypage.basic.post');

    Route::get('/mypage/edit/basic/confirm', "Hr_HrMypageBasicController@confirm")->name('hr.mypage.basic.confirm');
    Route::post('/mypage/edit/basic/confirm', "Hr_HrMypageBasicController@send")->name('hr.mypage.basic.send');

    Route::get('/mypage/edit/basic/thanks', "Hr_HrMypageBasicController@complete")->name('hr.mypage.basic.complete');
    /*--- end:基本情報の変更 ---------------------*/

    /*--- 詳細プロフィールの変更 -----------------*/
    Route::get('/mypage/edit/detail', "Hr_HrMypageDetailController@show")->name('hr.mypage.detail.show');
    Route::post('/mypage/edit/detail', "Hr_HrMypageDetailController@post")->name('hr.mypage.detail.post');

    Route::get('/mypage/edit/detail/confirm', "Hr_HrMypageDetailController@confirm")->name('hr.mypage.detail.confirm');
    Route::post('/mypage/edit/detail/confirm', "Hr_HrMypageDetailController@send")->name('hr.mypage.detail.send');

    Route::get('/mypage/edit/detail/thanks', "Hr_HrMypageDetailController@complete")->name('hr.mypage.detail.complete');
    /*--- end:詳細プロフィールの変更 ------------*/

    // from watch to stMypage
    Route::get('/mypage/{username}', 'Hr_StMypageController@index')->name('hr.stMypage');

    // from stMypage to detail
    Route::get('/mypage/{username}/detail', 'Hr_StMypageController@detail')->name('hr.stMypage.detail');

    /*=== end:mypage関係 =========================================================*/

    /*=== 人事マイページ関係 =============================================================*/
    // to HrMypage
    Route::get('/hrMypage/hrMypage', 'Hr_HrMypageController@index')->name('hr.hrMypage');


    /*=== end:人事マイページ関係 =========================================================*/

    // to 人事を探す(search) page
    Route::get('/interview/search', 'Hr_InterviewController@search')->name('hr.interview.search');


    //サービス内に動画をアップロードするルーティング
    Route::get('/upload', 'UploadController@show')->name('hr.upload');

    Route::get('/upload/form', "UploadController@show")->name('hr.form.show');
    Route::post('/upload/form', "UploadController@post")->name('hr.form.post');

    Route::get('/upload/form/confirm', "UploadController@confirm")->name('hr.form.confirm');
    Route::post('/upload/form/confirm', "UploadController@send")->name('hr.form.send');

    Route::get('/upload/form/thanks', "UploadController@complete")->name('hr.form.complete');
    //===========================================
