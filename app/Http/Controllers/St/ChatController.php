<?php

namespace App\Http\Controllers\St;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Common\RedirectClass;

use Auth;

use App\Models\User;
use App\Models\HrUser;
use App\Models\Message;
use App\Models\Offer;
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

        $chatsOffer = Offer::where('st_id', $userId)->with('hr_user:id,nickname,image_path')->get();
        $offerCollection = collect([]);
        foreach ($chatsOffer as $chat) {
            $latestMessage = Message::where('st_id', $userId)->where('hr_id', $chat->hr_user->id)->orderBy('id', 'desc')->first();
            $unread_message_num = Message::where('st_id', $userId)->where('hr_id', $chat->hr_user->id)->where('sender', 1)->where('unread', 1)->count();
            if(empty($latestMessage)){
                $body = "まだメッセージがありません。";
            }else{
                $body = $latestMessage->body;
            }
            $offerCollection = $offerCollection->concat([
                [
                    'id' => $chat->hr_user->id,
                    'nickname' => $chat->hr_user->nickname,
                    'imagePath' => $chat->hr_user->imagePath,
                    'latestMessage' => $body,
                    'unread' => $unread_message_num
                ],
            ]);
        }
        
        $chats = InterviewRequest::where('status', 1)->where('st_id', $userId)->with('hr_user:id,nickname,image_path')->get();
        $chatCollection = collect([]);
        foreach($chats as $chat){
            $latestMessage = Message::where('st_id', $userId)->where('hr_id', $chat->hr_user->id)->orderBy('id', 'desc')->first();
            $unread_message_num = Message::where('st_id', $userId)->where('hr_id', $chat->hr_user->id)->where('sender', 1)->where('unread', 1)->count();
            if(empty($latestMessage)){
                $body = "まだメッセージがありません。";
            }else{
                $body = $latestMessage->body;
            }
            $chatCollection = $chatCollection->concat([
                [
                    'id' => $chat->hr_user->id,
                    'nickname' => $chat->hr_user->nickname,
                    'imagePath' => $chat->hr_user->imagePath,
                    'latestMessage' => $body,
                    'unread' => $unread_message_num
                ],
            ]);
        }

        return view('st.chat.list', compact('chatCollection', 'offerCollection')); 
    }

    public function chat($id, Request $request)
    {
        //=====もし視聴不可状態のときはリダイレクト===================================
        if($redirect = RedirectClass::stRedirect()){
            if($redirect){
            return redirect()->action($redirect);
            }
        }
        //==========================================================================
  
        //pcかmobileか判断
        $user_agent =  $request->header('User-Agent');
        if ((strpos($user_agent, 'iPhone') !== false)
            || (strpos($user_agent, 'iPod') !== false)
            || (strpos($user_agent, 'Android') !== false)) {
            $spFlag = TRUE;
        } else {
            $spFlag = FALSE;
        }

        $stId = Auth::user()->id;
        $stImgPath = User::find($stId)->image_path;

        $hr = HrUser::find($id);
        $hrNickname = $hr->nickname;
        $hrImgPath = $hr->image_path;

        $unread_messages = Message::where('hr_id', $id)->where('st_id', $stId)->where('sender', 1)->get();
        foreach($unread_messages as $unread_message){
            $unread_message->unread = 0;
            $unread_message->save();
        }

        return view('st.chat.talk', compact('id', 'spFlag', 'hrNickname', 'stImgPath', 'hrImgPath')); 
    }
}
