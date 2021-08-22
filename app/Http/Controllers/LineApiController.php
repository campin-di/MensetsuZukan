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

                /* 絵文字 処理 */
                $code = '10008D';
                $bin = hex2bin(str_repeat('0', 8 - strlen($code)) . $code);
                $emoticon =  mb_convert_encoding($bin, 'UTF-8', 'UTF-32BE');
                /* 絵文字 処理 */

                $inputText = $input['events'][0]['message']['text'];

                $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
                // ビルダーにメッセージをすべて追加
                $answerArray = [
                    "質問1" => "動画は匿名・モザイク付きで公開されます。モザイクなしの動画を見ることができるのは、サービスに登録した人事のみとなります。",
                    "質問2" => "人事の企業名は基本的に非公開となっています。人事から学生にオファーが来た時点で、その学生にのみ企業情報が開示されます。",
                    "質問3" => "業界は様々ですが、面接官を行う方々は実際に企業で人事経験を積んでいます。また、こちらで作成したマニュアルに基づいて面接を行うため、一定の面接レベルは保証されます。",
                    "質問4" => "特定の企業を想定した面接ではないため、企業への志望理由は必要ありません。しかし、現時点で一番志望している業界とその理由は問われることがあります。",
                    "質問5" => "特定の企業を想定した面接ではないので、企業に受かるためではなく、自分の魅力を最大限に伝えるという意識で望んでいただければと思います。",
                    "質問6" => "スーツでなくても大丈夫です。あなたらしさを一番伝えられる服装でお越しください。",
                    "質問7" => "ハウリング・片方の音声しか録音されないといった問題がございますので、可能な限りマイク付きイヤホンでのご参加をお願いいたします。",
                    "質問8" => "いわゆる頻出質問と呼ばれるものを3問ほど出題します。解答に対しては、人事が自由に深堀を行います。",
                    "質問9" => "公開前の動画は一度運営がチェックしており、個人が特定される恐れがある発言はカットしています。もしご自身の発言内容に不安があれば、運営までお問い合わせください。",
                    "質問10" => "一度通信が安定するまでお待ちいただき、通信環境が改善されましたら再開します。再開の目途が立たない場合は後日面接を再設定となりますので、できるだけ通信環境を整えてご参加ください。",
                ];

                if(array_key_exists($inputText, $answerArray)){
                    $msgs = [
                        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($answerArray[$inputText]),
                    ];
                } else if($inputText == 'お問い合わせ'){
                    $questionObject = [
                            "質問1"  => ["面接までの不安・質問", "顔・氏名など個人情報が公開されたくありません。", "https://cdni.iconscout.com/illustration/free/thumb/virtual-assistant-2130746-1793975.png"],
                            "質問2"  => ["面接までの不安・質問", "面接官の企業名は事前に知ることができますか？", "https://cdni.iconscout.com/illustration/free/thumb/concept-of-data-privacy-and-policy-2112520-1785599.png"],
                            "質問3"  => ["面接までの不安・質問", "人事の方は本当の人事ですか？経験は豊富ですか？", "https://cdni.iconscout.com/illustration/free/thumb/task-list-2080780-1753768.png"],
                            "質問4"  => ["面接までの不安・質問", "志望理由は用意しておかないといけませんか？", "https://cdni.iconscout.com/illustration/free/thumb/to-do-list-2043017-1742872.png"],
                            "質問5"  => ["面接までの不安・質問", "事前に担当企業の「求める人材」を知ることはできますか？", "https://cdni.iconscout.com/illustration/free/thumb/innovation-technology-2080984-1751390.png"],
                            "質問6"  => ["面接までの不安・質問", "面接はスーツで受けなければなりませんか？", "https://cdni.iconscout.com/illustration/free/thumb/lost-business-man-talking-with-phone-and-asking-for-help-2130734-1797643.png"],
                            "質問7"  => ["面接までの不安・質問", "PC内蔵のスピーカーやマイクで面接を受けても大丈夫ですか？", "https://cdni.iconscout.com/illustration/free/thumb/concept-of-remote-team-2112518-1785598.png"],
                            "質問8"  => ["面接中の不安・質問", "どのような内容が質問されますか？", "https://cdni.iconscout.com/illustration/free/thumb/girl-moving-boxes-956460.png"],
                            "質問9"  => ["面接中の不安・質問", "誤って個人を特定できる発言をしてしまった場合は？", "https://cdni.iconscout.com/illustration/free/thumb/credit-card-2061889-1740012.png"],
                            "質問10"  => ["面接中の不安・質問", "面接中に回線が悪くなった場合は？", "https://cdni.iconscout.com/illustration/free/thumb/processing-2043026-1731285.png"],
                    ];
                    $columns = [];
                    foreach($questionObject as $key => $questionArray){
                        $action = new \LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder("質問の回答を表示する", $key);
                        $column = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder($questionArray[0], $questionArray[1], $questionArray[2], [$action]);
                        $columns[] = $column;
                    }

                    $carousel = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder($columns);
                    $carousel_message = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder('よくある質問',$carousel);

                    $msgs = [
                        $carousel_message,
                        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("①上記以外の質問がしたい。\n②面接図鑑の利用中の不具合。\n③個別に相談したいことがある。\nこの３点に当てはまる方は、\nmensetsu-zukan@pampam.co.jp\nにメールをお送りください".$emoticon),
                    ];

                } else {
                    $msgs = [
                        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("メッセージありがとうございます。\n面接図鑑です".$emoticon),
                        new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('お問い合わせ or よくある質問を知りたい方は、トーク画面下部の「お問い合わせ」をクリックしてください！'),
                    ];
                }
                foreach($msgs as $value){
                  $builder->add($value);
                }
                $response = $bot->replyMessage($reply_token, $builder);

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
