<?php

use Illuminate\Support\Facades\Route;

use App\Models\Video;

Route::get('/', function () {
    $stLoginFlag = Auth::check();
    if($stLoginFlag){
      return redirect()->action('St_HomeController@index');
    }
    $hrLoginFlag = Auth::guard('hr')->check();
    if($hrLoginFlag){
      return redirect()->action('Hr\HrHomeController@index');
    }

    $contentsNumber = Video::where('type', [0, 2])->count();

    return view('top', compact('contentsNumber'));
});

// top to 採用担当者ページ
Route::get('top/hr', function () {
  $contentsNumber = Video::where('type', 0)->count();

  return view('top_hr', compact('contentsNumber'));
})->name('top.hr');


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

//redirect to pre register page
Route::get('/pre/register', 'St_HomeController@preRegister')->name('pre.register');

Route::middleware(['auth'])->group(function() {
  //top to home
  Route::get('/home', 'St_HomeController@index')->name('home');

  //home to watch
  Route::get('/watch/{id}', 'St_WatchController@index')->name('watch');

  //watch to publicController
  Route::get('/watch/public/{video_id}', 'St_PublicController@index')->name('public');

  //mypage to interviewDetails
  Route::get('/interview/detail/{id}', 'St_InterviewController@detail')->name('interview.detail');

  //interviewDetails to cancel-confirm
  Route::get('/interview/cancel/{id}/confirm', 'St_InterviewController@cancelConfirm')->name('interview.cancel.confirm');

  Route::post('/interview/cancel/{id}', 'St_InterviewController@cancel')->name('interview.cancel');

  /*=== start: 面接リクエスト 関係 ===============================================*/
  // to 面接スケジュール page
  Route::get('/interview/request/{id}', 'St\RequestController@index')->name('interview.request');

  //mypage to request adding function
  Route::post('/interview/request/post', 'St\RequestController@post')->name('interview.request.post');

  Route::post('/interview/request/complete', "St\RequestController@send")->name('interview.request.send');
  
  //mypage to request check function
  Route::get('/interview/request/check', 'St\RequestController@check')->name('interview.request.check');
  
  //check to comfirm page
  Route::post('/interview/request/delete', 'St\RequestController@delete')->name('interview.request.delete');
  
  Route::get('/interview/request/delete/confirm', "St\RequestController@deleteConfirm")->name('interview.request.deleteConfirm');
  Route::post('/interview/request/delete/confirm', "St\RequestController@deleteSend")->name('interview.request.deleteSend');

  Route::get('/interview/request/delete/done', "St\RequestController@deleteComplete")->name('interview.request.delete.complete');
  /*=== end:面接リクエスト 関係 ===============================================*/

  /*=== start: チャット 関係 ===============================================*/
  Route::get('interview/chat/list', 'St\ChatController@list')->name('interview.chat.list');

  Route::get('interview/chat/talk/{id}', 'St\ChatController@chat')->name('interview.chat.talk');

  Route::get('ajax/chat', 'St\Ajax\ChatController@index'); // メッセージ一覧を取得
  Route::post('ajax/chat', 'St\Ajax\ChatController@create'); // チャット登録

  /*=== end:チャット 関係 ===============================================*/

  /*=== スケジュール登録 関係 ===============================================*/
  // to 面接スケジュール page
  Route::get('/interview/schedule/{id}', 'St_ScheduleController@schedule')->name('interview.schedule');
  
  //mypage to schedule adding function
  Route::post('/interview/schedule/post', 'St_ScheduleController@post')->name('interview.schedule.post');
  
  Route::get('/interview/schedule/confirm', "St_ScheduleController@confirm")->name('interview.schedule.confirm');
  Route::post('/interview/schedule/confirm', "St_ScheduleController@send")->name('interview.schedule.send');
  
  //mypage to schedule check function
  Route::get('/interview/schedule/check', 'St_ScheduleController@check')->name('interview.schedule.check');
  
  //check to comfirm page
  Route::post('/interview/schedule/delete', 'St_ScheduleController@delete')->name('interview.schedule.delete');
  
  Route::get('/interview/schedule/delete/confirm', "St_ScheduleController@deleteConfirm")->name('interview.schedule.deleteConfirm');
  Route::post('/interview/schedule/delete/confirm', "St_ScheduleController@deleteSend")->name('interview.schedule.deleteSend');

  Route::get('/interview/schedule/delete/done', "St_ScheduleController@deleteComplete")->name('interview.schedule.delete.complete');
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
  
  
  /*=== start: 管理画面 関係 =============================================================*/
  Route::get('/admin', 'AdminController@index')->name('admin');
  
  //動画編集用のコマンドを作成するフォームへのルーティング
  Route::get('/admin/comand', 'ComandController@index')->name('comand');
  //動画編集用のコマンドを作成するルーティング
  Route::get('/admin/comand/trim', 'ComandController@trim')->name('trim');
  //動画編集用のコマンドを作成するルーティング
  Route::get('/admin/comand/result', 'ComandController@result')->name('result');
 
  //Route::get('/admin/comand/result', 'ComandController@videoInterview')->name('result');

  //Route::get('/admin/comand/result', 'ComandController@stVideo')->name('result');

  //サービス内にコンテンツを登録するルーティング
  Route::get('/admin/register', 'UploadController@showRegister')->name('content.register');
  Route::post('/admin/register/complete', 'UploadController@register')->name("content.register.post");

  //サービス内に動画をアップロードするルーティング
  Route::get('/admin/upload', 'UploadController@showUpload')->name('upload');

  //サムネイル画像をアップロードするフォームへ
  Route::get('/admin/upload/thumbnail/{id}', 'UploadController@thumbnail')->name("thumbnail");

  //サムネイル画像をアップロード処理 and to 完了ページ
  Route::post('/admin/upload/thumbnail/upload', 'UploadController@thumbnailPost')->name("thumbnail.post");
  
  Route::get('/admin/upload/form', 'UploadController@show')->name("form.show");
  Route::post('/admin/upload/form', 'UploadController@post')->name("form.post");
  
  Route::get('/admin/upload/form/confirm', 'UploadController@confirm')->name("form.confirm");
  Route::post('/admin/upload/form/confirm', 'UploadController@send')->name("form.send");
  
  Route::get('/admin/upload/form/thanks', 'UploadController@complete')->name("form.complete");
  /*=== end: 管理画面 関係 =============================================================*/
});
  
  /*=== start: プライバシーポリシー関係 =============================================================*/
  //プライバシーポリシーページ
  Route::get('/policy', 'PolicyController@index')->name('policy');
  /*=== end: プライバシーポリシー関係 =============================================================*/
  
  /*=== end:管理画面 関係 =========================================================*/

/*=== 課金関係 =============================================================*/
Route::prefix('user')->middleware(['auth'])->group(function() {
  // 課金
  Route::get('subscription', 'User\SubscriptionController@audience')->name("subscription.audience");
  Route::get('ajax/subscription/status', 'User\Ajax\SubscriptionController@status');
  Route::post('ajax/subscription/subscribe', 'User\Ajax\SubscriptionController@subscribe');
  Route::post('ajax/subscription/cancel', 'User\Ajax\SubscriptionController@cancel');
  Route::post('ajax/subscription/resume', 'User\Ajax\SubscriptionController@resume');
  Route::post('ajax/subscription/change_plan', 'User\Ajax\SubscriptionController@change_plan');
  Route::post('ajax/subscription/update_card', 'User\Ajax\SubscriptionController@update_card');
});
/*=== end:課金関係 =========================================================*/

/************************ LINE *************************/
// line webhook受取用
Route::post('/line/callback',    'LineApiController@postWebhook');
// line メッセージ送信用
Route::get('/line/message/send', 'LineApiController@sendMessage');

// ソーシャル・ログイン
Route::prefix('login/{provider}')->where(['provider' => '(line|github)'])->group(function(){
  Route::get('/', 'Auth\LoginController@redirectToProvider')->name('social_login.redirect');
  Route::get('/callback', 'Auth\LoginController@handleProviderCallback')->name('social_login.callback');
});

Route::prefix('register/{provider}')->where(['provider' => '(line|github)'])->group(function(){
  Route::get('/', 'Auth\RegisterController@redirectToProvider')->name('social_register.redirect');
  Route::get('/callback', 'Auth\RegisterController@handleProviderCallback')->name('social_register.callback');
});

Route::prefix('line/{provider}')->where(['provider' => '(line|github)'])->group(function(){
  Route::get('/', 'St_HomeController@redirectToProvider')->name('social_line.redirect');
});