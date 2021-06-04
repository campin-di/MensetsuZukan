<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $stLoginFlag = Auth::check();
    if($stLoginFlag){
      return redirect()->action('St_HomeController@index');
    }
    $hrLoginFlag = Auth::guard('hr')->check();
    if($hrLoginFlag){
      return redirect()->action('Hr\HrHomeController@index');
    }
    return view('top');
});

/*=== 認証関係 =============================================================*/
Auth::routes();

Route::prefix('hr')->namespace('Hr')->name('hr.')->group(function(){
    Auth::routes();

    Route::get('/home', 'HrHomeController@index')->name('hr_home');
});

// top to 学生or人事選択ぺージ
Route::get('register/choice', 'Auth\RegisterController@choice')->name('register.choice');
// 仮会員登録ページ to 仮会員登録確認ページ
Route::post('register/pre_check', 'Auth\PreRegisterController@pre_check')->name('register.pre_check');
// メール　to 本登録フォーム
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
// 本登録フォーム1 to 本登録フォーム2
Route::post('register/2', 'Auth\RegisterController@showForm2')->name('register2');
Route::get('register/2', 'Auth\RegisterController@redirectShowForm2')->name('redirect.register2');
// 本登録フォーム2 to 本登録フォーム3
Route::post('register/3', 'Auth\RegisterController@showForm3')->name('register3');
// 本登録フォーム3 to 本登録フォーム4
Route::post('register/4', 'Auth\RegisterController@showForm4')->name('register4');
// 本登録フォーム4 to 本登録フォーム（投稿者専用）
Route::post('register/plan', 'Auth\RegisterController@showFormPlan')->name('register.plan');

//　本登録フォーム to 本登録確認画面
Route::post('register/main/post', 'Auth\RegisterController@post')->name('register.main.post');

Route::get('register/main/confirm', "Auth\RegisterController@confirm")->name('register.main.confirm');
// 本登録確認画面 to 本登録完了画面
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');
/*=== end:認証関係 =========================================================*/

//redirect to pre contributor page
Route::get('/pre/contributor', 'St_HomeController@preContributor')->name('pre.contributor');

//redirect to pre audience page
Route::get('/pre/audience', 'St_HomeController@preAudience')->name('pre.audience');

//top to home
Route::get('/home', 'St_HomeController@index')->name('home');

//home to watch
Route::get('/watch/{id}', 'St_WatchController@index')->name('watch');

//mypage to interviewDetails
Route::get('/interview/detail/{id}', 'St_InterviewController@detail')->name('interview.detail');

//interviewDetails to cancel-confirm
Route::get('/interview/cancel/{id}/confirm', 'St_InterviewController@cancelConfirm')->name('interview.cancel.confirm');

Route::post('/interview/cancel/{id}', 'St_InterviewController@cancel')->name('interview.cancel');
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

/*--- プロフィール画像のアップロード  -------------------------*/
Route::get('/mypage/upload/{id}', 'St_MypageBasicController@upload')->name('mypage.basic.upload');
Route::post('/mypage/upload/complete', 'St_MypageBasicController@uploadPost')->name('mypage.basic.upload.post');

/*--- 基本情報の変更 -------------------------*/
Route::get('/mypage/edit/basic', 'St_MypageBasicController@show')->name("mypage.basic.show");
Route::post('/mypage/edit/basic', 'St_MypageBasicController@post')->name("mypage.basic.post");

Route::get('/mypage/edit/basic/confirm', 'St_MypageBasicController@confirm')->name("mypage.basic.confirm");
Route::post('/mypage/edit/basic/confirm', 'St_MypageBasicController@send')->name("mypage.basic.send");

Route::get('/mypage/edit/basic/thanks', 'St_MypageBasicController@complete')->name("mypage.basic.complete");
/*--- end:基本情報の変更 ---------------------*/

/*--- 詳細プロフィールの変更 -----------------*/
Route::get('/mypage/edit/detail/step1', 'St_MypageDetailController@step1')->name("mypage.detail.step1");
Route::post('/mypage/edit/detail/step2', 'St_MypageDetailController@step2')->name("mypage.detail.step2");
Route::post('/mypage/edit/detail', 'St_MypageDetailController@post')->name("mypage.detail.post");

Route::get('/mypage/edit/detail/confirm', 'St_MypageDetailController@confirm')->name("mypage.detail.confirm");
Route::post('/mypage/edit/detail/confirm', 'St_MypageDetailController@send')->name("mypage.detail.send");

Route::get('/mypage/edit/detail/thanks', 'St_MypageDetailController@complete')->name("mypage.detail.complete");
/*--- end:詳細プロフィールの変更 ------------*/

// from watch to stPage
Route::get('/stpage/{id}', 'St_MypageController@stpage')->name('stpage');

// from stPage to detail
Route::get('/stpage/{id}/detail', 'St_MypageController@stDetail')->name('stpage.detail');

/*=== end:mypage関係 =========================================================*/

/*=== 人事マイページ関係 =============================================================*/
// to hrMypage
Route::get('/hrpage/{id}', 'St_HrMypageController@index')->name('hrpage');

// from hrMypage to detail
Route::get('/hrpage/detail/{id}', 'St_HrMypageController@detail')->name('hrpage.detail');

/*=== end:人事マイページ関係 =========================================================*/

// to 人事を探す(search) page
Route::get('/interview/search', 'St_InterviewController@search')->name('interview.search');

// to 面接スケジュール page
Route::get('/interview/schedule/{id}', 'St_ScheduleController@schedule')->name('interview.schedule');


/*=== 管理画面 関係 =============================================================*/

Route::get('/admin', 'AdminController@index')->name('admin');

//サービス内に動画をアップロードするルーティング
Route::get('/admin/upload', 'UploadController@show')->name('upload');
//サムネイル画像をアップロードするフォームへ
Route::get('/admin/upload/thumbnail/{id}', 'UploadController@thumbnail')->name("thumbnail");
//サムネイル画像をアップロード処理 and to 完了ページ
Route::post('/admin/upload/thumbnail/upload', 'UploadController@thumbnailPost')->name("thumbnail.post");


Route::get('/admin/upload/form', 'UploadController@show')->name("form.show");
Route::post('/admin/upload/form', 'UploadController@post')->name("form.post");

Route::get('/admin/upload/form/confirm', 'UploadController@confirm')->name("form.confirm");
Route::post('/admin/upload/form/confirm', 'UploadController@send')->name("form.send");

Route::get('/admin/upload/form/thanks', 'UploadController@complete')->name("form.complete");
//===========================================
/*=== end:管理画面 関係 =========================================================*/


Route::get('/subscription', 'StripeController@subscription')->name('stripe.subscription');
Route::post('/subscription/afterpay', 'StripeController@afterpay')->name('stripe.afterpay');
