<?php

namespace App\Http\Controllers\Hr\Offer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\HrUser;
use App\Models\Interview;
use App\Models\Schedule;
use App\Common\CutStringClass;
use App\Common\ReturnUserInformationArrayClass;

class SearchController extends Controller
{
    public function search()
    {
      $status = [
        config('const.USER_STATUS.UNAVAILABLE'),
        config('const.USER_STATUS.AVAILABLE'),
      ];
      $sts = User::whereIn('status', $status)->where('graduate_year', 2023)->get();
  
      $industries = ReturnUserInformationArrayClass::returnIndustry();
      $jobtypes = ReturnUserInformationArrayClass::returnJobTypeArray();
      $companyTypes = ReturnUserInformationArrayClass::returnCompanyTypeArray();
      $university_classes = ReturnUserInformationArrayClass::returnUniversityClassArray();
      $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
      $startTimes = ReturnUserInformationArrayClass::returnStartTimeArray();
      $englishLevels = ReturnUserInformationArrayClass::returnEnglishLevelArray();
      $toeics = ReturnUserInformationArrayClass::returnToeicArray();
  
      $stCollection = collect([]);
      foreach ($sts as $st) {
        $stCollection = $stCollection->concat([
          [
            'id' => $st->id,
            'name' => $st->name,
            'nickname' => $st->nickname,
            'imagePath' => $st->image_path,
            'university' => $st->university,
            'university_class' => $st->university_class,
            'company_type' => explode('（',$st->company_type)[0],
            'industry' => CutStringClass::CutString($st->industry, 20),
            'jobtype' => CutStringClass::CutString($st->jobtype, 15),
            'selectionPhase' => $st->selection_phase,
            'introduction' => CutStringClass::CutString($st->introduction, 105),
            'status' => $st->status,
          ],
        ]);
      }
  
      return view('hr/offer/search', compact(
        'stCollection', 'university_classes', 'industries', 'prefecturesArray', 'jobtypes', 'companyTypes', 'startTimes', 'englishLevels', 'toeics', 
    ));
  }

    public function search_filter(Request $request)
    {
        $status = [
            config('const.USER_STATUS.UNAVAILABLE'),
            config('const.USER_STATUS.AVAILABLE'),
        ];

        $request_industry = request('industry');
        $request_jobtype = request('jobtype');
        $request_company_type = request('company_type');
        $request_university_class = request('university_class');
        $request_workplace = request('workplace');
        $request_english_level = request('english_level');
        $request_toeic = request('toeic');
        $request_status = request('status');
        $request_gender = request('gender');
        
        $sts = User::whereIn('status', $status)->where('graduate_year', 2023)
            ->industryfilter($request_industry)
            ->jobtypefilter($request_jobtype)
            ->companytypefilter($request_company_type)
            ->universityclassfilter($request_university_class)
            ->workplacefilter($request_workplace)
            ->englishlevelfilter($request_english_level)
            ->toeicfilter($request_toeic)
            ->statusfilter($request_status)
            ->genderfilter($request_gender)
            ->get();
        
        $university_classes = ReturnUserInformationArrayClass::returnUniversityClassArray();
        $industries = ReturnUserInformationArrayClass::returnIndustry();
        $companyTypes = ReturnUserInformationArrayClass::returnCompanyTypeArray();
        $prefecturesArray = ReturnUserInformationArrayClass::returnPrefectures();
        $jobtypes = ReturnUserInformationArrayClass::returnJobTypeArray();
        $startTimes = ReturnUserInformationArrayClass::returnStartTimeArray();
        $englishLevels = ReturnUserInformationArrayClass::returnEnglishLevelArray();
        $toeics = ReturnUserInformationArrayClass::returnToeicArray();

        $stCollection = collect([]);
        foreach ($sts as $st) {
        $stCollection = $stCollection->concat([
            [
            'id' => $st->id,
            'name' => $st->name,
            'nickname' => $st->nickname,
            'imagePath' => $st->image_path,
            'university' => $st->university,
            'university_class' => $st->university_class,
            'company_type' => explode('（',$st->company_type)[0],
            'industry' => CutStringClass::CutString($st->industry, 20),
            'jobtype' => CutStringClass::CutString($st->jobtype, 15),
            'selectionPhase' => $st->selection_phase,
            'introduction' => CutStringClass::CutString($st->introduction, 105),
            'status' => $st->status,
            ],
        ]);
      }
  
      return view('hr/offer/search', compact(
          'stCollection', 'university_classes', 'industries', 'prefecturesArray', 'jobtypes', 'companyTypes', 'startTimes', 'englishLevels', 'toeics', 
          'request_industry', 'request_jobtype', 'request_workplace', 'request_company_type', 'request_status', 'request_english_level', 'request_toeic', 'request_gender', 'request_university_class', 
        ));
    }
}
