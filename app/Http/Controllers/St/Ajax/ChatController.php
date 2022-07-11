<?php

namespace App\Http\Controllers\St\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Events\MessageCreated;
use App\Models\HrUser;
use App\Models\Message;

use Auth;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    public function index(Request $request) {// 新着順にメッセージ一覧を取得

        $userId = Auth::user()->id;
        $messages = Message::orderBy('id', 'asc')->where('st_id', $userId)->where('hr_id', $request->input('id'))->get();

        return $messages;
    }
    
    public function create(Request $request) { // メッセージを登録
        $today = date("n/j");
        $now = date("G:i");

        $st = Auth::user();
        $hr = HrUser::find($request->hrId);

        $message = new Message;
        $message->st_id = $st->id;
        $message->hr_id = $hr->id;
        $message->sender = 0;
        $message->date = $today;
        $message->time = $now;
        $message->body = $request->message;
        $message->unread = 1;
        $message->save();

        Mail::send('st/chat/mail/notification', ['hr' => $hr, 'st' => $st],
            function ($mail) use ($hr, $st){
                $mail->subject($st->nickname. 'さんからの新着メッセージ');
                $mail->from('mensetsuzukan@pampam.co.jp', 'デジマ面接図鑑');
                $mail->to($hr->email);
            }
        );

        event(new MessageCreated($message));
    }
}
