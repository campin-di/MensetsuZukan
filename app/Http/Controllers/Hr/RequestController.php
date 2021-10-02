<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\InterviewRequest;
use App\Models\Message;

use Illuminate\Support\Facades\Mail;
use Log;

use App\Common\CutStringClass;

class RequestController extends Controller
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

    public function index()
    {
        $userId = Auth::guard('hr')->id();
        $requests = InterviewRequest::where('hr_id', $userId)->where('status', 0)->with('st_user:id,nickname,industry,university_class,image_path,introduction,company_type')->get();
        
        $stCollection = collect([]);
        foreach ($requests as $request) {
            $stUser = $request->st_user;
            $stCollection = $stCollection->concat([
                [
                'id' => $stUser->id,
                'nickname' => $stUser->nickname,
                'imagePath' => $stUser->image_path,
                'companyType' => $stUser->company_type,
                'industry' => $stUser->industry,
                'universityClass' => $stUser->university_class,
                'introduction' => CutStringClass::CutString($stUser->introduction, 105),
                ],
            ]);
        }
  
        return view('hr/interview/request/request_list', compact('stCollection'));
    }

    public function form($st_id)
    {
  
      return view('hr/interview/request/form', compact('st_id'));
    }

    public function post(Request $request)
    {
        $input = $request->all();
        $request->session()->put("form_input", $input);

        //セッションから値を取り出す
        $input = $request->session()->get("form_input");

        //セッションに値が無い時はフォームに戻る
        if(!$input){
        return redirect()->action("Hr\RequestController@index");
        }

        $reactionFlag = TRUE;
        if($input['reaction'] == 'reject'){
            $reactionFlag = FALSE;
            return view("hr/interview/request/form_confirm", compact('reactionFlag'));
        }

        return view("hr/interview/request/form_confirm", compact('reactionFlag'));
    }

    function send(Request $request){
        //セッションから値を取り出す
        $input = $request->session()->get("form_input");

        //見送り理由を取り出す（承諾の場合：NULL）
        $rejectMessage = NULL;
        if($request->has('reject-reason')){
            $rejectMessage = $request->input('reject-reason');
        }
    
        //戻るボタンが押された時
        if($request->has("back")){
          return redirect()->action("Hr\RequestController@index")
            ->withInput($input);
        }
    
        //セッションに値が無い時はフォームに戻る
        if(!$input){
          return redirect()->action("Hr\RequestController@index");
        }
    
        $hr_id = Auth::guard('hr')->id();
        $hr = HrUser::find($hr_id);
    
        $st_id = $input['st_id'];
        $st = User::find($st_id);

        $reactionFlag = TRUE;
        //reject だった場合、リクエストデータを削除
        if($input['reaction'] == 'reject'){
            $reactionFlag = FALSE;
      
            //学生と人事の組み合わせに該当する面接リクエストデータを削除
            InterviewRequest::where('hr_id', $hr_id)->where('st_id', $st_id)->delete();
        } else {
            $interviewRequest = InterviewRequest::where('hr_id', $hr_id)->where('st_id', $st_id)->get()[0];
            $interviewRequest->status = 1;
            $interviewRequest->save();
        }

        $this->lineNotification($st, $hr, $rejectMessage);

        if($input['reaction'] != 'reject'){
            // メッセージに自動送信 
            $requestDate = $interviewRequest->schedule_candidate;
            $autoMessage = "※本メッセージは自動配信です。\n\n".$st->nickname."さんは、下記の日程での模擬面接を希望しています。\n-----------------\n". $requestDate. "\n-----------------\n".$hr->nickname."さんの日程と合う場合は「面接予約」へ。\n合わない場合は".$st->nickname."さんと日程調整を行ってください。\n\n面接予約に進まれる場合、このメッセージへの返信は不要です。";

            $today = date("n/j");
            $now = date("G:i");
    
            $message = new Message;
            $message->st_id = $st_id;
            $message->hr_id = $hr_id;
            $message->sender = 0;
            $message->date = $today;
            $message->time = $now;
            $message->body = $autoMessage;
            $message->save();
        }
        //セッションを空にする
        $request->session()->forget("form_input");

        return view("hr/interview/request/form_complete");
    }    

    public function lineNotification($st, $hr, $rejectMessage) { // 面接予約時にLINE通知する関数
        //本会員登録リンク 送信部分
        $http_client = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($this->access_token);
        $bot         = new \LINE\LINEBot($http_client, ['channelSecret' => $this->channel_secret]);

        $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
        // ビルダーにメッセージをすべて追加
        if(is_null($rejectMessage)){
            $msgs = [
                new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('面接申し込みが承諾されました！'),
                new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('トーク画面右下の「マイページ」より面接図鑑にログインし、「メッセージ」から面接に関する情報をご確認ください。'),
            ];
        } else {
            $msgs = [
                new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("面接リクエストが見送られました。\n--- 理由 --------\n".$rejectMessage. "\n-----------------"),
                new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('別の人事にも面接申し込みを行ってみてください！'),
            ];
        }
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
