<?php

use Illuminate\Support\Facades\Route;

    //prefix('hr')は指定箇所のルートの先頭に'hr.'をつける

    //home to watch
    Route::get('/watch/{id}', 'Hr_WatchController@index')->name('hr.watch');

    //mypage to interview detail
    Route::get('/interview/detail/{id}', 'Hr_InterviewController@detail')->name('hr.interview.detail');

    //interview detail to interview preStart
    Route::get('/interview/pre/{id}', 'Hr_InterviewController@pre')->name('hr.interview.pre');


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
    //detail to question form
    Route::get('/interview/question/add/{id}', 'Hr_QuestionListController@add')->name('hr.interview.question.add');

    //question form to comfirm page
    Route::post('/interview/question/post', 'Hr_QuestionListController@post')->name('hr.interview.question.post');

    Route::get('/interview/question/confirm', "Hr_QuestionListController@confirm")->name('hr.interview.question.confirm');
    Route::post('/interview/question/confirm', "Hr_QuestionListController@send")->name('hr.interview.question.send');

    Route::get('/interview/question/thanks', "Hr_QuestionListController@complete")->name('hr.interview.question.complete');
    /*=== end:質問リスト登録 関係 ===============================================*/

    /*=== 質問リスト編集 関係 ===============================================*/
    //detail to question form
    Route::get('/interview/question/add/{id}', 'Hr_QuestionListController@edit')->name('hr.interview.question.edit');

    //question form to comfirm page
    Route::post('/interview/question/post', 'Hr_QuestionListController@editPost')->name('hr.interview.question.edit.post');

    Route::get('/interview/question/confirm', "Hr_QuestionListController@editConfirm")->name('hr.interview.question.edit.confirm');
    Route::post('/interview/question/confirm', "Hr_QuestionListController@editSend")->name('hr.interview.question.edit.send');

    Route::get('/interview/question/thanks', "Hr_QuestionListController@editComplete")->name('hr.interview.question.edit.complete');
    /*=== end:質問リスト登録 関係 ===============================================*/

    /*=== 採点機能 関係 ===============================================*/
    //detail to scoring form
    Route::get('/interview/scoring/form/{id}', 'Hr_ScoringController@form')->name('hr.interview.scoring.form');

    //scoring form to comfirm page
    Route::post('/interview/scoring/post', 'Hr_ScoringController@post')->name('hr.interview.scoring.post');

    Route::get('/interview/scoring/confirm', "Hr_ScoringController@confirm")->name('hr.interview.scoring.confirm');
    Route::post('/interview/scoring/confirm', "Hr_ScoringController@send")->name('hr.interview.scoring.send');

    Route::get('/interview/scoring/thanks', "Hr_ScoringController@complete")->name('hr.interview.scoring.complete');
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
