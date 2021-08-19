<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Common\GoogleSheetClass;
use App\Models\Interview;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Log;

class LineRemind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '面接日程が近づくとLINEでリマインドを送る';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        // :point_down: アクセストークン
        $this->access_token = env('LINE_ACCESS_TOKEN');
        // :point_down: チャンネルシークレット
        $this->channel_secret = env('LINE_CHANNEL_SECRET');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $interviews = Interview::where('date', date('Y-m-d', strtotime('+1 day')))->with('st_user:id,line_id')->get();
        //remind 送信部分
        foreach($interviews as $interview){
            $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
            $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);
            $message = '模擬面接は明日です！面接情報の詳細や面接をする方法などは下部メニュー「マイページ」→面接予定リストより確認してください！';
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
            $response    = $bot->pushMessage($interview->st_user->line_id, $textMessageBuilder);
        
            // 配信成功・失敗
            if ($response->isSucceeded()) {
                Log::info('Line 送信完了');
            } else {
                Log::error('投稿失敗: ' . $response->getRawBody());
            }
        }

        $interviews3 = Interview::where('date', date('Y-m-d', strtotime('+3 day')))->with('st_user:id,line_id')->get();
        foreach($interviews3 as $interview3){
            $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
            $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);
            $message = '面接まであと３日になりました！下部メニュー「マイページ」→面接予定リストより面接情報を確認しておきましょう！';
            $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
            $response    = $bot->pushMessage($interview3->st_user->line_id, $textMessageBuilder);
        
            // 配信成功・失敗
            if ($response->isSucceeded()) {
                Log::info('Line 送信完了');
            } else {
                Log::error('投稿失敗: ' . $response->getRawBody());
            }
        }
        return 0;
    }
}
