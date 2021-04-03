<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $loginFlag = Auth::check();
    if($loginFlag){
      return redirect()->action('HomeController@index');
    }
    return view('top');
});

Auth::routes();

//top to home
Route::get('/home', 'HomeController@index')->name('home');

//home to watch
Route::get('/watch/{id}', 'WatchController@index')->name('watch');

//mypage to interviewDetails
Route::get('/interview/pre/{id}', 'InterviewController@preStart')->name('interview.preStart');

/*=== マイページ関係 =============================================================*/
// mypage to detail Page
Route::get('/mypage/detail', 'MypageController@myDetail')->name('mypage.detail');

//to mypage
Route::get('/mypage', 'MypageController@index')->name('mypage');

/*--- 基本情報の変更 -------------------------*/
Route::get('/mypage/edit/basic', "MypageBasicController@show")->name("mypage.basic.show");
Route::post('/mypage/edit/basic', "MypageBasicController@post")->name("mypage.basic.post");

Route::get('/mypage/edit/basic/confirm', "MypageBasicController@confirm")->name("mypage.basic.confirm");
Route::post('/mypage/edit/basic/confirm', "MypageBasicController@send")->name("mypage.basic.send");

Route::get('/mypage/edit/basic/thanks', "MypageBasicController@complete")->name("mypage.basic.complete");
/*--- end:基本情報の変更 ---------------------*/

/*--- 詳細プロフィールの変更 -----------------*/
Route::get('/mypage/edit/detail', "MypageDetailController@show")->name("mypage.detail.show");
Route::post('/mypage/edit/detail', "MypageDetailController@post")->name("mypage.detail.post");

Route::get('/mypage/edit/detail/confirm', "MypageDetailController@confirm")->name("mypage.detail.confirm");
Route::post('/mypage/edit/detail/confirm', "MypageDetailController@send")->name("mypage.detail.send");

Route::get('/mypage/edit/detail/thanks', "MypageDetailController@complete")->name("mypage.detail.complete");
/*--- end:詳細プロフィールの変更 ------------*/

// from watch to theirPage
Route::get('/mypage/{username}', 'MypageController@TheirPage')->name('mypage.theirPage');

// from theirPage to detail
Route::get('/mypage/{username}/detail', 'MypageController@TheirDetail')->name('mypage.theirDetail');

/*=== end:mypage関係 =========================================================*/

// to 人事を探す(search) page
Route::get('/interview/search', 'InterviewController@search')->name('interview.search');


//サービス内に動画をアップロードするルーティング
Route::get('/upload', 'UploadController@show')->name('upload');

Route::get('/upload/form', "UploadController@show")->name("form.show");
Route::post('/upload/form', "UploadController@post")->name("form.post");

Route::get('/upload/form/confirm', "UploadController@confirm")->name("form.confirm");
Route::post('/upload/form/confirm', "UploadController@send")->name("form.send");

Route::get('/upload/form/thanks', "UploadController@complete")->name("form.complete");
//===========================================
