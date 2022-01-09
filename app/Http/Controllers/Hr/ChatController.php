<?php

namespace App\Http\Controllers\Hr;

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
        if($redirect = RedirectClass::hrOfferRedirect()){
            if($redirect){
                return redirect()->action($redirect);
            }
        }
        //==========================================================================

        $userId = Auth::guard('hr')->id();
        $userData = HrUser::find($userId);

        $chatsOffer = Offer::where('hr_id', $userId)->with('st_user:id,name,nickname,image_path,university')->get();
        $offerCollection = collect([]);
        foreach($chatsOffer as $chat){
            $latestMessage = Message::where('hr_id', $userId)->where('st_id', $chat->st_user->id)->orderBy('id', 'desc')->first();
            $unread_message_num = Message::where('hr_id', $userId)->where('st_id', $chat->st_user->id)->where('sender', 0)->where('unread', 1)->count();
            
            if(empty($latestMessage)){
                $body = "まだメッセージがありません。";
            }else{
                $body = $latestMessage->body;
            }
            $offerCollection = $offerCollection->concat([
                [
                    'id' => $chat->st_user->id,
                    'name' => $chat->st_user->name,
                    'nickname' => $chat->st_user->nickname,
                    'university' => $chat->st_user->university,
                    'imagePath' => $chat->st_user->image_path,
                    'latestMessage' => $body,
                    'unread' => $unread_message_num,
                ],
            ]);
        }
        
        $chats = InterviewRequest::where('status', 1)->where('hr_id', $userId)->with('st_user:id,name,nickname,image_path,university')->get();
        $chatCollection = collect([]);
        foreach ($chats as $chat) {
            $latestMessage = Message::where('hr_id', $userId)->where('st_id', $chat->st_user->id)->orderBy('id', 'desc')->first();
            $unread_message_num = Message::where('hr_id', $userId)->where('st_id', $chat->st_user->id)->where('sender', 0)->where('unread', 1)->count();
            if(empty($latestMessage)){
                $body = "まだメッセージがありません。";
            }else{
                $body = $latestMessage->body;
            }
            $chatCollection = $chatCollection->concat([
                [
                    'id' => $chat->st_user->id,
                    'name' => $chat->st_user->name,
                    'nickname' => $chat->st_user->nickname,
                    'imagePath' => $chat->st_user->image_path,
                    'university' => $chat->st_user->university,
                    'latestMessage' => $body,
                    'unread' => $unread_message_num,
                ],
            ]);
        }

        if($userData->plan == "hr"){
            return view('hr.chat.list', compact('offerCollection', 'chatCollection')); 
        } else{
            return view('hr.chat.list_offer', compact('offerCollection', 'chatCollection')); 
        }
    }

    public function chat($id, Request $request)
    {
        //=====もし視聴不可状態のときはリダイレクト===================================
        if($redirect = RedirectClass::hrOfferRedirect()){
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

        $hrId = Auth::guard('hr')->id();
        $hrImgPath = HrUser::find($hrId)->image_path;

        $st = User::find($id);
        $stName = $st->name;
        $stNickname = $st->nickname;
        $stImgPath = $st->image_path;

        $unread_messages = Message::where('hr_id', $hrId)->where('st_id', $id)->where('sender', 0)->get();
        foreach($unread_messages as $unread_message){
            $unread_message->unread = 0;
            $unread_message->save();
        }

        return view('hr.chat.talk', compact('id', 'spFlag', 'stName', 'stNickname', 'stImgPath', 'hrImgPath')); 
    }
}
