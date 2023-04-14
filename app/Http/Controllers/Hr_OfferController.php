<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferMail;
use App\Common\RedirectClass;

use Auth;
use Log;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Offer;
use App\Models\Message;


class Hr_OfferController extends Controller
{
  public function __construct()
  {
      // :point_down: アクセストークン
      $this->access_token = env('LINE_ACCESS_TOKEN');
      // :point_down: チャンネルシークレット
      $this->channel_secret = env('LINE_CHANNEL_SECRET');
  }

  public function form($stId)
  {
    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::hrRedirect()){
      if($redirect){
        return redirect()->action($redirect);
      }
    }
    //==========================================================================

    $stData = User::find($stId);
    return view('hr/offer/form', compact('stData'));
  }

  public function post(Request $request)
  {

    $input = $request->all();

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_OfferController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->route('hr.hr_home');
    }

    $stData = User::find($input['stId']);
    return view("hr/offer/form_confirm",[
      'stData' => $stData,
      'offerContent' => $input['offer_content'],
      'message' => $input['message'],
    ]);
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->route('hr.hr_home');
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->route('hr.hr_home');
    }

    //=====処理内容====================================
    $userId = Auth::guard('hr')->id();
    $hr = HrUser::find($userId);
    $st = User::find($input['stId']);

    $offer = new Offer;
    $offer->hr_id = $userId;
    $offer->st_id = $st->id;
    $offer->content = $input['offer_content'];
    $offer->message = $input['message'];
    $offer->save();

    $today = date("n/j");
    $now = date("G:i");

    $message = new Message;
    $message->st_id = $st->id;
    $message->hr_id = $userId;
    $message->sender = 1;
    $message->date = $today;
    $message->time = $now;
    $message->body = '『'.$input['offer_content']."』\n\n". $input['message'];;
    $message->save();

    $this->lineNotification($st, $hr);
    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_OfferController@complete");
  }

  function complete(){
    return view("hr/offer/form_complete");
  }

  public function lineNotification($st, $hr) { // 面接予約時にLINE通知する関数
    //本会員登録リンク 送信部分
    $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
    $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

    $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
    // ビルダーにメッセージをすべて追加
    $msgs = [
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($hr->company. 'からオファーがありました！'),
        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('デジマ面接図鑑にログインし、「メッセージ」からオファー内容に返信してください。'),
    ];
    foreach($msgs as $value){
      $builder->add($value);
    }
    $response = $bot->pushMessage($st->line_id, $builder);

    // 配信成功・失敗
    if ($response->isSucceeded()) {
        Log::info('Line 送信完了');
    } else {
        Log::error('投稿失敗: ' . $response->getRawBody());
    }
  }

}
