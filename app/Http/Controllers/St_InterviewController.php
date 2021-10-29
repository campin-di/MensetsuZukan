<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Interview;
use App\Models\Schedule;
use App\Common\CutStringClass;
use App\Common\ReturnUserInformationArrayClass;


class St_InterviewController extends Controller
{
  public function detail($id)
  {
    $interviewInfo = Interview::with('hr_user')->find($id);

    return view('st/interview/detail', [
      'interviewInfo' => $interviewInfo,
    ]);
  }

  public function search()
  {
    $status = [
      config('const.USER_STATUS.UNAVAILABLE'),
      config('const.USER_STATUS.AVAILABLE'),
    ];
    $hrs = HrUser::inRandomOrder()->whereIn('status', $status)->get();

    $industries = ReturnUserInformationArrayClass::returnIndustry();
    $companyTypes = ReturnUserInformationArrayClass::returnCompanyTypeArray();
    $stockTypes = ReturnUserInformationArrayClass::returnStockTypeArray();
    $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();

    $hrCollection = collect([]);
    foreach ($hrs as $hr) {
      $hrCollection = $hrCollection->concat([
        [
          'id' => $hr->id,
          'nickname' => $hr->nickname,
          'imagePath' => $hr->image_path,
          'industry' => $hr->industry,
          'company_type' => $hr->company_type,
          'stock_type' => $hr->stock_type,
          'location' => $hr->location,
          'selectionPhase' => $hr->selection_phase,
          'introduction' => CutStringClass::CutString($hr->introduction, 105),
        ],
      ]);
    }

    return view('st/interview/search', compact('hrCollection', 'industries', 'stockTypes', 'prefecturesArray'));
  }

  public function cancelConfirm($id)
  {
    return view('st/interview/cancel/confirm', compact('id'));
  }

  public function cancel($id)
  {
    $interviewInfo = Interview::with('hr_user')->find($id);
    
    $hr_id = $interviewInfo->hr_user->id;
    $hr = HrUser::find($hr_id);
    $st = User::find(Auth::user()->id);

    $mailDateArray = [
      'date' => $interviewInfo->date,
      'time' => $interviewInfo->time,
    ];

    $interviewInfo->delete();

    Mail::send('st/interview/schedule/mail/cancel', ['mailDateArray' => $mailDateArray, 'hr' => $hr, 'st' => $st],
      function ($message) use ($hr, $st){
        $message->subject($st->name. 'さんとの面接がキャンセルされました。');
        $message->from('mensetsuzukan@pampam.co.jp', '面接図鑑');
        $message->to($hr->email);
      }
    );

    return view('st/interview/cancel/complete');
  }
}
