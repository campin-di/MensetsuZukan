<?php

namespace App\Http\Controllers\Hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Common\RedirectClass;

use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Message;
use App\Models\InterviewRequest;

class ChatController extends Controller
{
    public function list()
    {
        //=====もし視聴不可状態のときはリダイレクト===================================
        if($redirect = RedirectClass::hrOfferRedirect()){
            if($redirect){
                return redirect()->action($redirect);
            }
        }
        //==========================================================================

        $userId = Auth::guard('hr')->id();

        $chats = InterviewRequest::where('status', 1)->where('hr_id', $userId)->with('st_user:id,nickname,image_path')->get();

        $chatCollection = collect([]);
        foreach ($chats as $chat) {
            $latestMessage = Message::where('hr_id', $userId)->where('st_id', $chat->st_user->id)->orderBy('id', 'desc')->first();
            $chatCollection = $chatCollection->concat([
            [
                'id' => $chat->st_user->id,
                'nickname' => $chat->st_user->nickname,
                'imagePath' => $chat->st_user->imagePath,
                'latestMessage' => $latestMessage->body,
            ],
            ]);
        }

        return view('hr.chat.list', compact('chatCollection')); 
    }

    public function chat($id)
    {
        //=====もし視聴不可状態のときはリダイレクト===================================
        if($redirect = RedirectClass::hrOfferRedirect()){
            if($redirect){
            return redirect()->action($redirect);
            }
        }
        //==========================================================================
  
        $hrId = Auth::guard('hr')->id();
        $hrImgPath = User::find($hrId)->image_path;

        $st = User::find($id);
        $stNickname = $st->nickname;
        $stImgPath = $st->image_path;

        return view('hr.chat.talk', compact('id', 'stNickname', 'stImgPath', 'hrImgPath')); 
    }
}
