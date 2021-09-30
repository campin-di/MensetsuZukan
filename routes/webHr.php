<?php

use Illuminate\Support\Facades\Route;
use App\Models\Video;

    Route::get('/', function () {
        $loginFlag = Auth::guard('hr')->check();
        if($loginFlag){
          return redirect()->action('Hr\HrHomeController@index');
        }
        Auth::logout();
        $contentsNumber = Video::where('type', 0)->count();
        return view('top', compact("contentsNumber"));
    })->name('hr.home');

    /*=== 認証関係 =============================================================*/
    // 仮会員登録ページ to 仮会員登録確認ページ
    Route::post('/register/pre_check', 'Hr\Auth\PreRegisterController@pre_check')->name('hr.register.pre_check');

    // メール　to 本登録フォーム
    Route::get('/register/verify/{token}', 'Hr\Auth\RegisterController@showForm');
    // 本登録フォーム1 to 本登録フォーム2
    Route::post('/register/2', 'Hr\Auth\RegisterController@showForm2')->name('hr.register2');
    Route::get('/register/2', 'Hr\Auth\RegisterController@showForm2')->name('hr.register2');

    // 本登録フォーム2 to 本登録フォーム3
    Route::post('/register/3', 'Hr\Auth\RegisterController@showForm3')->name('hr.register3');
    Route::get('/register/3', 'Hr\Auth\RegisterController@redirectshowForm3')->name('hr.register3.redirect');

    // 本登録フォーム3 to 本登録フォーム4
    Route::post('/register/4', 'Hr\Auth\RegisterController@showForm4')->name('hr.register4');

    //　本登録フォーム to 本登録確認画面
    Route::post('/register/main/post', 'Hr\Auth\RegisterController@post')->name('hr.register.main.post');

    Route::get('/register/main/confirm', "Hr\Auth\RegisterController@confirm")->name('hr.register.main.confirm');
    // 本登録確認画面 to 本登録完了画面
    Route::post('/register/main_register', 'Hr\Auth\RegisterController@mainRegister')->name('hr.register.main.registered');
    /*=== end:認証関係 =========================================================*/

    //redirect to pre contributor page
    Route::get('/pre/register', 'Hr\HrHomeController@preRegister')->name('pre.register');

    //redirect to pre contributor page
    Route::get('/pre/hr', 'Hr\HrHomeController@preHr')->name('pre.hr');

    //redirect to pre audience page
    Route::get('/pre/offer', 'Hr\HrHomeController@preOffer')->name('pre.offer');

    //home to watch
    Route::get('/watch/{id}', 'Hr_WatchController@index')->name('hr.watch');

    //mypage to interview detail
    Route::get('/interview/detail/{id}', 'Hr_InterviewController@detail')->name('hr.interview.detail');

    //interview detail to interview preStart
    Route::get('/interview/pre/{id}', 'Hr_InterviewController@pre')->name('hr.interview.pre');

    /*=== オファー機能 関係 ===============================================*/
    //detail to scoring form
    Route::get('/offer/form/{id}', 'Hr_OfferController@form')->name('hr.offer.form');

    //scoring form to comfirm page
    Route::post('/offer/post', 'Hr_OfferController@post')->name('hr.offer.post');

    Route::get('/offer/confirm', "Hr_OfferController@confirm")->name('hr.offer.confirm');
    Route::post('/offer/confirm', "Hr_OfferController@send")->name('hr.offer.send');

    Route::get('/offer/thanks', "Hr_OfferController@complete")->name('hr.offer.complete');
    /*=== end:オファー機能 関係 ===============================================*/

    /*=== 面接リクエスト 関係 ===============================================*/
    //mypage to request adding function
    Route::get('/interview/request/request_list', 'Hr\RequestController@index')->name('hr.interview.request');
    //mypage to request adding function
    Route::get('/interview/request/form/{st_id}', 'Hr\RequestController@form')->name('hr.interview.request.form');
    //form to comfirm page
    Route::post('/interview/request/confirm', 'Hr\RequestController@post')->name('hr.interview.request.post');
    //comfirm page to complete page
    Route::post('/interview/request/complete', "Hr\RequestController@send")->name('hr.interview.request.send');

    /*=== end:面接リクエスト 関係 ===============================================*/

    /*=== start: チャット 関係 ===============================================*/
    Route::get('interview/chat/list', 'Hr\ChatController@list')->name('hr.interview.chat.list');

    Route::get('interview/chat/talk/{id}', 'Hr\ChatController@chat')->name('hr.interview.chat.talk');

    Route::get('ajax/chat', 'Hr\Ajax\ChatController@index'); // メッセージ一覧を取得
    Route::post('ajax/chat', 'Hr\Ajax\ChatController@create'); // チャット登録

    /*=== end:チャット 関係 ===============================================*/

    /*=== スケジュール登録 関係 ===============================================*/
    //mypage to schedule adding function
    //Route::get('/interview/schedule/request_list', 'Hr\ScheduleController@request')->name('hr.interview.schedule.request');
    
    //mypage to schedule adding function
    Route::get('/interview/schedule/form/{st_id}', 'Hr\ScheduleController@schedule')->name('hr.interview.schedule.form');
    
    //form to comfirm page
    Route::post('/interview/schedule/post', 'Hr\ScheduleController@post')->name('hr.interview.schedule.post');
    Route::get('/interview/schedule/confirm', "Hr\ScheduleController@confirm")->name('hr.interview.schedule.confirm');

    Route::post('/interview/schedule/confirm', "Hr\ScheduleController@send")->name('hr.interview.schedule.send');

    Route::get('/interview/schedule/thanks', "Hr\ScheduleController@complete")->name('hr.interview.schedule.complete');

    //interview detail to cancel-confirm
    Route::get('/interview/cancel/{id}/confirm', 'Hr_InterviewController@cancelConfirm')->name('hr.interview.cancel.confirm');

    Route::post('/interview/cancel/{id}/done', 'Hr_InterviewController@cancel')->name('hr.interview.cancel');
    /*=== end:スケジュール登録 関係 ===============================================*/

    /*=== 質問リスト登録 関係 ===============================================*/
    //detail to question form
    Route::get('/interview/question/add/{id}', 'Hr_QuestionListController@add')->name('hr.interview.question.add');

    //question form to comfirm page
    Route::post('/interview/question/post', 'Hr_QuestionListController@post')->name('hr.interview.question.post');

    Route::get('/interview/question/confirm', "Hr_QuestionListController@confirm")->name('hr.interview.question.confirm');
    Route::post('/interview/question/confirm', "Hr_QuestionListController@send")->name('hr.interview.question.send');

    Route::get('/interview/question/{id}/thanks', "Hr_QuestionListController@complete")->name('hr.interview.question.complete');
    /*=== end:質問リスト登録 関係 ===============================================*/

    /*=== 質問リスト編集 関係 ===============================================*/
    //detail to question form
    Route::get('/interview/question/edit/{id}', 'Hr_QuestionListController@edit')->name('hr.interview.question.edit');

    //question form to comfirm page
    Route::post('/interview/question/edit/post', 'Hr_QuestionListController@editPost')->name('hr.interview.question.edit.post');

    Route::get('/interview/question/edit/confirm', "Hr_QuestionListController@editConfirm")->name('hr.interview.question.edit.confirm');
    Route::post('/interview/question/edit/confirm', "Hr_QuestionListController@editSend")->name('hr.interview.question.edit.send');

    Route::get('/interview/question/edit/thanks', "Hr_QuestionListController@editComplete")->name('hr.interview.question.edit.complete');
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

    /*--- プロフィール画像のアップロード  -------------------------*/
    Route::get('/mypage/upload/{id}', 'Hr_HrMypageBasicController@upload')->name('hr.mypage.basic.upload');
    Route::post('/mypage/upload/complete', 'Hr_HrMypageBasicController@uploadPost')->name('hr.mypage.basic.upload.post');

    /*--- 基本情報の変更 -------------------------*/
    Route::get('/mypage/edit/basic', "Hr_HrMypageBasicController@show")->name('hr.mypage.basic.show');
    Route::post('/mypage/edit/basic', "Hr_HrMypageBasicController@post")->name('hr.mypage.basic.post');

    Route::get('/mypage/edit/basic/confirm', "Hr_HrMypageBasicController@confirm")->name('hr.mypage.basic.confirm');
    Route::post('/mypage/edit/basic/confirm', "Hr_HrMypageBasicController@send")->name('hr.mypage.basic.send');

    Route::get('/mypage/edit/basic/thanks', "Hr_HrMypageBasicController@complete")->name('hr.mypage.basic.complete');
    /*--- end:基本情報の変更 ---------------------*/

    /*--- 詳細プロフィールの変更 -----------------*/
    Route::get('/mypage/edit/detail/step1', "Hr_HrMypageDetailController@step1")->name('hr.mypage.detail.step1');
    Route::post('/mypage/edit/detail/step2', "Hr_HrMypageDetailController@step2")->name('hr.mypage.detail.step2');

    Route::post('/mypage/edit/detail', "Hr_HrMypageDetailController@post")->name('hr.mypage.detail.post');

    Route::get('/mypage/edit/detail/confirm', "Hr_HrMypageDetailController@confirm")->name('hr.mypage.detail.confirm');
    Route::post('/mypage/edit/detail/confirm', "Hr_HrMypageDetailController@send")->name('hr.mypage.detail.send');

    Route::get('/mypage/edit/detail/thanks', "Hr_HrMypageDetailController@complete")->name('hr.mypage.detail.complete');
    /*--- end:詳細プロフィールの変更 ------------*/

    /*--- 自分以外の人事ページ 関係 -------------------------*/
    // to hr hrpage
    Route::get('/hrpage/{id}', 'Hr_HrMypageController@hrpage')->name('hr.hrpage');
    // from hr hrpage to detail
    Route::get('/hrpage/{id}/detail', 'Hr_HrMypageController@hrDetail')->name('hr.hrpage.detail');
    /*--- end:自分以外の人事ページ 関係 -------------------------*/

    // from watch to stMypage
    Route::get('/stpage/{id}', 'Hr_StMypageController@index')->name('hr.stpage');

    // from stMypage to detail
    Route::get('/stpage/{id}/detail', 'Hr_StMypageController@detail')->name('hr.stpage.detail');

    /*=== end:mypage関係 =========================================================*/

    /*=== start: プライバシーポリシー関係 =============================================================*/
    //プライバシーポリシーページ
    Route::get('/policy', 'PolicyController@hrIndex')->name('hr.policy');
    /*=== end: プライバシーポリシー関係 =============================================================*/


    // to 人事を探す(search) page
//    Route::get('/interview/search', 'Hr_InterviewController@search')->name('hr.interview.search');
