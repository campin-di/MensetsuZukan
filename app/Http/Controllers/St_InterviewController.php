<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    $hrs = HrUser::whereIn('status', $status)->get();

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
    $hrSchedule = Schedule::where('hr_id', $interviewInfo->hr_id)->where('date', $interviewInfo->date)->first();

    $timeArray = ReturnUserInformationArrayClass::returnTimeArray();
    foreach ($timeArray as $key => $value) {
      if($value == $interviewInfo->time){
        $hrSchedule->$key = 1;
        $hrSchedule->save();
      }
    }

    $interviewInfo->delete();

    return view('st/interview/cancel/complete');
  }
}
