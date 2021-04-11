<?php

use Illuminate\Support\Facades\Route;


//テスト
Route::get('youtube/channels/{id}/titles', 'YoutubeController@getListByChannelId');


Route::get('/', function () {
    $loginFlag = Auth::check();
    if($loginFlag){
      return redirect()->action('St_HomeController@index');
    }
    return view('top');
});

/*=== 認証関係 =============================================================*/
Auth::routes();

Route::prefix('hr')->namespace('Hr')->name('hr.')->group(function(){
    Auth::routes();

    Route::get('/home', 'HrHomeController@index')->name('hr_home');
});
/*=== end:認証関係 =========================================================*/

//top to home
Route::get('/home', 'St_HomeController@index')->name('home');

//home to watch
Route::get('/watch/{id}', 'St_WatchController@index')->name('watch');

//mypage to interviewDetails
Route::get('/interview/pre/{id}', 'St_InterviewController@preStart')->name('interview.preStart');

/*=== スケジュール登録 関係 ===============================================*/

//mypage to schedule adding function
Route::post('/interview/schedule/post', 'St_ScheduleController@post')->name('interview.schedule.post');

Route::get('/interview/schedule/confirm', "St_ScheduleController@confirm")->name('interview.schedule.confirm');
Route::post('/interview/schedule/confirm', "St_ScheduleController@send")->name('interview.schedule.send');

Route::get('/interview/schedule/thanks', "St_ScheduleController@complete")->name('interview.schedule.complete');
/*=== end:スケジュール登録 関係 ===============================================*/

/*=== マイページ関係 =============================================================*/
//to mypage
Route::get('/mypage', 'St_MypageController@index')->name('mypage');

// mypage to detail Page
Route::get('/mypage/detail', 'St_MypageController@myDetail')->name('mypage.detail');

/*--- 基本情報の変更 -------------------------*/
Route::get('/mypage/edit/basic', 'St_MypageBasicController@show')->name("mypage.basic.show");
Route::post('/mypage/edit/basic', 'St_MypageBasicController@post')->name("mypage.basic.post");

Route::get('/mypage/edit/basic/confirm', 'St_MypageBasicController@confirm')->name("mypage.basic.confirm");
Route::post('/mypage/edit/basic/confirm', 'St_MypageBasicController@send')->name("mypage.basic.send");

Route::get('/mypage/edit/basic/thanks', 'St_MypageBasicController@complete')->name("mypage.basic.complete");
/*--- end:基本情報の変更 ---------------------*/

/*--- 詳細プロフィールの変更 -----------------*/
Route::get('/mypage/edit/detail', 'St_MypageDetailController@show')->name("mypage.detail.show");
Route::post('/mypage/edit/detail', 'St_MypageDetailController@post')->name("mypage.detail.post");

Route::get('/mypage/edit/detail/confirm', 'St_MypageDetailController@confirm')->name("mypage.detail.confirm");
Route::post('/mypage/edit/detail/confirm', 'St_MypageDetailController@send')->name("mypage.detail.send");

Route::get('/mypage/edit/detail/thanks', 'St_MypageDetailController@complete')->name("mypage.detail.complete");
/*--- end:詳細プロフィールの変更 ------------*/

// from watch to theirPage
Route::get('/mypage/{username}', 'St_MypageController@TheirPage')->name('mypage.theirPage');

// from theirPage to detail
Route::get('/mypage/{username}/detail', 'St_MypageController@TheirDetail')->name('mypage.theirDetail');

/*=== end:mypage関係 =========================================================*/

/*=== 人事マイページ関係 =============================================================*/
// to hrMypage
Route::get('/hrMypage/mypage/{id}', 'St_HrMypageController@index')->name('hr_mypage');

// from hrMypage to detail
Route::get('/hrMypage/mypage/{id}/detail', 'St_HrMypageController@detail')->name('hr_mypage.detail');

/*=== end:人事マイページ関係 =========================================================*/

// to 人事を探す(search) page
Route::get('/interview/search', 'St_InterviewController@search')->name('interview.search');

// to 面接スケジュール page
Route::get('/interview/schedule/{id}', 'St_ScheduleController@schedule')->name('interview.schedule');

//サービス内に動画をアップロードするルーティング
Route::get('/upload', 'UploadController@show')->name('upload');

Route::get('/upload/form', 'UploadController@show')->name("form.show");
Route::post('/upload/form', 'UploadController@post')->name("form.post");

Route::get('/upload/form/confirm', 'UploadController@confirm')->name("form.confirm");
Route::post('/upload/form/confirm', 'UploadController@send')->name("form.send");

Route::get('/upload/form/thanks', 'UploadController@complete')->name("form.complete");
//===========================================
