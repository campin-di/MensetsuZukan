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

//to mypage
Route::get('/mypage', 'MypageController@index')->name('mypage');


//サービス内に動画をアップロードするルーティング
Route::get('/upload', 'UploadController@show')->name('upload');

Route::get('/upload/form', "UploadController@show")->name("form.show");
Route::post('/upload/form', "UploadController@post")->name("form.post");

Route::get('/upload/form/confirm', "UploadController@confirm")->name("form.confirm");
Route::post('/upload/form/confirm', "UploadController@send")->name("form.send");

Route::get('/upload/form/thanks', "UploadController@complete")->name("form.complete");
//===========================================
