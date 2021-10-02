<?php

namespace App\Http\Controllers\Hr\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Events\MessageCreated;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Message;

use Auth;
use Log;

class ChatController extends Controller
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

    public function index(Request $request) {// 新着順にメッセージ一覧を取得

        $userId = Auth::guard('hr')->id();
        $messages = Message::orderBy('id', 'asc')->where('hr_id', $userId)->where('st_id', $request->input('id'))->get();

        return $messages;
    }
    
    public function create(Request $request) { // メッセージを登録

        $stId = $request->stId;
        $hrId = Auth::guard('hr')->id();
        $st = User::find($stId);
        $hr = HrUser::find($hrId);

        $today = date("n/j");
        $now = date("G:i");

        $message = new Message;
        $message->st_id = $stId;
        $message->hr_id = $hrId;
        $message->sender = 1;
        $message->date = $today;
        $message->time = $now;
        $message->body = $request->message;
        $message->save();

        $this->lineNotification($st, $hr);

        event(new MessageCreated($message));
    }

    public function lineNotification($st, $hr) { // メッセージ送信時に学生にLINE通知する関数
        //本会員登録リンク 送信部分
        Log::info('Lin');

        $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
        $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);


        $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
        // ビルダーにメッセージをすべて追加
        $msgs = [
            new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($hr->nickname.'さんから新着メッセージを受信しました！'),
            new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('トーク画面下「マイページ」より面接図鑑にログインし、「メッセージ」からご確認ください。'),
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
