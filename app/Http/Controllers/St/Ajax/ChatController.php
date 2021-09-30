<?php

namespace App\Http\Controllers\St\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Events\MessageCreated;
use App\Models\Message;

use Auth;

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

        $message = new Message;
        $message->st_id = Auth::user()->id;
        $message->hr_id = $request->hrId;
        $message->sender = 0;
        $message->date = $today;
        $message->time = $now;
        $message->body = $request->message;
        $message->save();

        event(new MessageCreated($message));
    }
}
