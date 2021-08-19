<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Log;

class LineApiController extends Controller
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

    // Webhook受取処理
    public function postWebhook(Request $request) {
        $input = $request->all();
        // ユーザーがどういう操作を行った処理なのかを取得
        $type  = $input['events'][0]['type'];
    
        // タイプごとに分岐
        switch ($type) {
            // メッセージ受信
            case 'message':
                // メッセージ受信
                // 返答に必要なトークンを取得
                $reply_token = $input['events'][0]['replyToken'];
                // テスト投稿の場合
                if ($reply_token == '00000000000000000000000000000000') {
                    Log::info('Succeeded');
                    return;
                }
                // Lineに送信する準備
                $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
                $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);
                // LINEの投稿処理
                $message_data = "メッセージありがとうございます。ただいま準備中です";
                $response     = $bot->replyText($reply_token, $message_data);

                // Succeeded
                if ($response->isSucceeded()) {
                    Log::info('返信成功');
                    break;
                }
                // Failed
                Log::error($response->getRawBody());
                break;
                break;
    
            // 友だち追加 or ブロック解除
            case 'follow':
                // ユーザー固有のIDを取得
                $line_user_id = $request['events'][0]['source']['userId'];
                // ユーザー固有のIDはどこかに保存しておいてください。メッセージ送信の際に必要です。
                Log::info("ユーザーを追加しました。 user_id = " . $line_user_id);

                $userData = User::where('line_id', $line_user_id)->where('status', config('const.USER_STATUS.PRE_REGISTER'));
                if($userData->exists()){
                    $user = $userData->first();
                    $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
                    $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);
                
                    $message = url('register/verify/'. $user->email_verify_token);
                    $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
                    $response    = $bot->pushMessage($line_user_id, $textMessageBuilder);
                
                    // 配信成功・失敗
                    if ($response->isSucceeded()) {
                        Log::info('Line 送信完了');
                    } else {
                        Log::error('投稿失敗: ' . $response->getRawBody());
                    }          
                }
                break;

            // グループ・トークルーム参加
            case 'join':
                Log::info("グループ・トークルームに追加されました。");
                break;
    
            // グループ・トークルーム退出
            case 'leave':
                Log::info("グループ・トークルームから退出させられました。");
                break;
    
            // ブロック
            case 'unfollow':
                Log::info("ユーザーにブロックされました。");
                break;
    
            default:
                Log::info("the type is" . $type);
                break;
        }
    
        return;
    }

    // メッセージ送信用
    public function sendMessage(Request $request) {
        // ここに処理を書いていく
    }
}
