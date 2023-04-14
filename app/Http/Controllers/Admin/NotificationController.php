<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Log;

class NotificationController extends Controller
{
    protected $access_token;
    protected $channel_secret;
  
    public function __construct()
    {
        // :point_down: アクセストークン
        $this->access_token = env('LINE_ACCESS_TOKEN');
        // :point_down: チャンネルシークレット
        $this->channel_secret = env('LINE_CHANNEL_SECRET');
    }

    public function show()
    {
        return view('admin/notification/form');
    }

    public function confirm(Request $request)
    {
        $input = $request->all();
        //セッションに書き込む
        $request->session()->put("notification", $input);

        return view('admin/notification/confirm',compact('input'));
    }
    
    public function send(Request $request)
    {
        //セッションから値を取り出す
        $input = $request->session()->get("notification");

        //セッションに値が無い時はフォームに戻る
        if(!$input){
            return redirect()->action("AdminController@index");
        }

        $idArray = explode(' ', $input['ids']);

        foreach($idArray as $id){
            $st = User::find($id);
            if(!is_null($st->line_id)){
                $this->lineNotification($st, $input['message']);
            }
        }

        return view('admin/notification/complete');
    }

    //イベント告知で一斉告知する関数
    public function eventNotification()
    {
        $sts = User::whereNotNull('line_id')->get();
        
        foreach($sts as $st){
            //$this->lineEventNotification($st);
        }
        return view('admin/notification/complete');
    }

    public function lineNotification($st, $message) { // LINE通知する関数
        //本会員登録リンク 送信部分
        $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
        $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

        $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
        // ビルダーにメッセージをすべて追加
        $msgs = [
            new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message),
            new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("※上記のメッセージは配信専用です。ご不明点・お問い合わせは、下記メールアドレスよりお願いいたします。\n mensetsu-zukan@pampam.co.jp"),
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
    
    public function lineEventNotification($st) { // LINEでイベント告知する関数
        //本会員登録リンク 送信部分
        $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
        $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

        $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
        // ビルダーにメッセージをすべて追加
        $imageUrl = "https://pbs.twimg.com/media/FCDZgdFVcAAsyzd?format=jpg&name=large";
        $msgs = [
            new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($st->nickname."さん！\nデジマ面接図鑑をご利用いただきありがとうございます。\n\nこの度、利用者数＆Twitterフォロワー300人突破を記念して、Amazonギフト券・スタバドリンクチケットがもらえるキャンペーンを開始します！\n\n詳細は下記ポスターよりご確認ください！"),
            new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($imageUrl, $imageUrl),
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
