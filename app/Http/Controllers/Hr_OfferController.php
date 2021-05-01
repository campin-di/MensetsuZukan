<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfferMail;
use App\Common\RedirectClass;

use Auth;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Offer;

class Hr_OfferController extends Controller
{
  private $formItems = ["name", "title", "body"];

  private $validator = [
    /*
    "name" => "required|string|max:100",
    "title" => "required|string|max:100",
    "body" => "required|string|max:100"
    */
  ];

  public function form($username)
  {
    //=====もし視聴不可状態のときはリダイレクト===================================
    if($redirect = RedirectClass::hrRedirect()){
      if($redirect){
        return redirect()->action($redirect);
      }
    }
    //==========================================================================

    return view('hr/offer/form',[
      'username' => $username,
    ]);
  }

  public function post(Request $request)
  {

    $input = $request->all();

    //=====部分処理====================================
/*
    $validator = Validator::make($input, $this->validator);
    if($validator->fails()){
      return redirect()->action("Hr_OfferController@show")
        ->withInput()
        ->withErrors($validator);
    }
*/
    //================================================

    //セッションに書き込む
    $request->session()->put("form_input", $input);

    return redirect()->action("Hr_OfferController@confirm");
  }

  function confirm(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->route('hr.hr_home');
    }
    return view("hr/offer/form_confirm",['input' => $input]);
  }

  function send(Request $request){
    //セッションから値を取り出す
    $input = $request->session()->get("form_input");

    //戻るボタンが押された時
    if($request->has("back")){
      return redirect()->route('hr.hr_home');
    }

    //セッションに値が無い時はフォームに戻る
    if(!$input){
      return redirect()->route('hr.hr_home');
    }

    //=====処理内容====================================
    $userId = Auth::guard('hr')->id();
    $hr = HrUser::with('company')->find($userId);

    $st = User::where('username', $input['username'])->first();

    $offer = new Offer;
    $offer->hr_id = $userId;
    $offer->st_id = $st->id;
    $offer->content = $input['offer_content'];
    $offer->message = $input['message'];
    $offer->save();
    //Mail::to($st->email)->send(new OfferMail($offer));
    Mail::send('hr/offer/mail/example1', ['offer' => $offer, 'hr' => $hr, 'st' => $st], function ($message) use ($offer, $hr, $st){
      $message->subject($hr->company->name. 'からオファーがありました！');
      $message->from($hr->email, $hr->name);
      $message->to($st->email)->cc('mensetsu_zukan@example.com');
    });
    //================================================

    //セッションを空にする
    $request->session()->forget("form_input");

    return redirect()->action("Hr_OfferController@complete");
  }

  function complete(){
    return view("hr/offer/form_complete");
  }

}
