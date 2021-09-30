<?php

namespace App\Http\Controllers\St;

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
        if($redirect = RedirectClass::stRedirect()){
            if($redirect){
                return redirect()->action($redirect);
            }
        }
        //==========================================================================
        $userId = Auth::user()->id;

        $chats = InterviewRequest::where('status', 1)->where('st_id', $userId)->with('hr_user:id,nickname,image_path')->get();
        
        $chatCollection = collect([]);
        foreach ($chats as $chat) {
            $latestMessage = Message::where('st_id', $userId)->where('hr_id', $chat->hr_user->id)->orderBy('id', 'desc')->first();
            $chatCollection = $chatCollection->concat([
            [
                'id' => $chat->hr_user->id,
                'nickname' => $chat->hr_user->nickname,
                'imagePath' => $chat->hr_user->imagePath,
                'latestMessage' => $latestMessage->body,
            ],
            ]);
        }
        return view('st.chat.list', compact('chatCollection')); 
    }

    public function chat($id)
    {
        //=====もし視聴不可状態のときはリダイレクト===================================
        if($redirect = RedirectClass::stRedirect()){
            if($redirect){
            return redirect()->action($redirect);
            }
        }
        //==========================================================================
  
        $stId = Auth::user()->id;
        $stImgPath = User::find($stId)->image_path;

        $hr = HrUser::find($id);
        $hrNickname = $hr->nickname;
        $hrImgPath = $hr->image_path;

        return view('st.chat.talk', compact('id', 'hrNickname', 'stImgPath', 'hrImgPath')); 
    }
}
