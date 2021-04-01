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

/*=== mypage関係 =============================================================*/
//to mypage
Route::get('/mypage', 'MypageController@index')->name('mypage');

/*--- 基本情報の変更 -----------*/
Route::get('/mypage/edit/basic', "MypageBasicController@show")->name("mypage.basic.show");
Route::post('/mypage/edit/basic', "MypageBasicController@post")->name("mypage.basic.post");

Route::get('/mypage/edit/basic/confirm', "MypageBasicController@confirm")->name("mypage.basic.confirm");
Route::post('/mypage/edit/basic/confirm', "MypageBasicController@send")->name("mypage.basic.send");

Route::get('/mypage/edit/basic/thanks', "MypageBasicController@complete")->name("mypage.basic.complete");
/*------------------------------------------*/

/*--- 詳細プロフィールの変更 -----------*/
Route::get('/mypage/edit/detail', "MypageDetailController@show")->name("mypage.detail.show");
Route::post('/mypage/edit/detail', "MypageDetailController@post")->name("mypage.detail.post");

Route::get('/mypage/edit/detail/confirm', "MypageDetailController@confirm")->name("mypage.detail.confirm");
Route::post('/mypage/edit/detail/confirm', "MypageDetailController@send")->name("mypage.detail.send");

Route::get('/mypage/edit/detail/thanks', "MypageDetailController@complete")->name("mypage.detail.complete");
/*------------------------------------------*/

//from mypage to detail Page
Route::get('/mypage/detail', 'MypageController@detail')->name('mypage.detail');
/*=== end:mypage関係 =========================================================*/

//サービス内に動画をアップロードするルーティング
Route::get('/upload', 'UploadController@show')->name('upload');

Route::get('/upload/form', "UploadController@show")->name("form.show");
Route::post('/upload/form', "UploadController@post")->name("form.post");

Route::get('/upload/form/confirm', "UploadController@confirm")->name("form.confirm");
Route::post('/upload/form/confirm', "UploadController@send")->name("form.send");

Route::get('/upload/form/thanks', "UploadController@complete")->name("form.complete");
//===========================================
