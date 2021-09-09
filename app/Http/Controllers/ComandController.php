<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\GoogleSheetClass;
use App\Models\User;
use App\Models\Interview;
use App\Models\Video;

class ComandController extends Controller
{
    public function index()
    {
      return view('admin.comand.form');
    }

    public function trim(Request $request)
    {
        /*=== スプシから情報を取得する処理 =================*/
        $spreadsheet_service = GoogleSheetClass::instance();
        $spreadsheet_id = '1N_IZkPLLnB-dcg4T8Qr5vSC46AGA-NsINPwLdJd1rCA';
        $contentsArray = $spreadsheet_service->spreadsheets_values->get($spreadsheet_id, '質問の区切れ!A2:F')["values"];
        $values = new \Google_Service_Sheets_ValueRange();

        $loop = 1;
        foreach($contentsArray as $contentArray){
            $loop++;
            if(array_key_exists(5, $contentArray)){
                continue;
            }
            $folderName = $contentArray[0];
            $question1_end = $this->cut($contentArray[2]);
            $question2_end = $this->cut($contentArray[3]);
            $question3_end = $this->cut($contentArray[4]);
            
            $question1_start = $this->cut($contentArray[1]);
            $question2_start = $question1_end - 2;
            $question3_start = $question2_end - 2;
            
            $question1_while = $question1_end - $question1_start + 2;
            $question2_while = $question2_end - $question1_end + 2;
            $question3_while = $question3_end - $question2_end + 2;
            
            $cmd = [
                'make folder name="' . $folderName .'"',
                'make edit name="'. $folderName .'" st1="' . $question1_start . '" end1="'. $question1_while. '" st2="'. $question2_start .'" end2="'. $question2_while .'" st3="'. $question3_start .'" end3="' . $question3_while. '"',
                'make join name="'. $folderName .'"',
            ];
            $values->setValues([
                'values' => $cmd
            ]);
            $params = ['valueInputOption' => 'USER_ENTERED'];
            $spreadsheet_service->spreadsheets_values->append(
                $spreadsheet_id,
                'コマンド!A2',
                $values,
                $params
            );
            
            $values->setValues([
                'values' => 1
            ]);
            $spreadsheet_service->spreadsheets_values->append(
                $spreadsheet_id,
                '質問の区切れ!F'.$loop,
                $values,
                $params
            );
        }

        return view('admin.comand.form_complete');
    }

    function cut($time){
        $secs = explode(':', $time);
        $sec = $secs[0]*60 + $secs[1];

        return $sec;
    }

    public function result(Request $request)
    {
        /*=== スプシから情報を取得する処理 =================*/
        $spreadsheet_service = GoogleSheetClass::instance();
        $spreadsheet_id = '1N_IZkPLLnB-dcg4T8Qr5vSC46AGA-NsINPwLdJd1rCA';
        $contentsArray = $spreadsheet_service->spreadsheets_values->get($spreadsheet_id, '質問の区切れ!A2:F')["values"];
        $values = new \Google_Service_Sheets_ValueRange();

        $interviews = Interview::orderBy('date', 'asc')->where('available', -1)->with('hr_user:id,name,nickname')->with('st_user:id,name,nickname')->with('question1')->with('question2')->with('question3')->get();
        
        foreach($interviews as $interview){
            $result = [
                $interview->id,
                $interview->st_user->name. '('. $interview->st_user->nickname . ')',
                $interview->hr_user->name. '('. $interview->hr_user->nickname . ')',
                $interview->question1->name,
                $interview->question2->name,
                $interview->question3->name,
                $interview->date,
                $interview->time,
            ];
            $values->setValues([
                'values' => $result
            ]);
            $params = ['valueInputOption' => 'USER_ENTERED'];
            $spreadsheet_service->spreadsheets_values->append(
                $spreadsheet_id,
                '面接結果!A2',
                $values,
                $params
            );
        }

        return view('admin.comand.form_complete');
    }

    public function videoInterview()
    {
        /*=== スプシから情報を取得する処理 =================*/
        $spreadsheet_service = GoogleSheetClass::instance();
        $spreadsheet_id = '1N_IZkPLLnB-dcg4T8Qr5vSC46AGA-NsINPwLdJd1rCA';
        $contentsArray = $spreadsheet_service->spreadsheets_values->get($spreadsheet_id, '質問の区切れ!A2:F')["values"];
        $values = new \Google_Service_Sheets_ValueRange();

        $videos = Video::get();
        
        foreach($videos as $video){
            $interview = Interview::where('st_id', $video->st_id)->where('hr_id', $video->hr_id)->with('st_user:id,name')->first();
            $result = [
                $video->id,
                $interview->id,
                $interview->st_user->name,
                $interview->hr_user->name,
            ];
            $values->setValues([
                'values' => $result
            ]);
            $params = ['valueInputOption' => 'USER_ENTERED'];
            $spreadsheet_service->spreadsheets_values->append(
                $spreadsheet_id,
                'videoとinterview!A2',
                $values,
                $params
            );
        }

        return view('admin.comand.form_complete');
    }

    public function stVideo(Request $request)
    {
        /*=== スプシから情報を取得する処理 =================*/
        $spreadsheet_service = GoogleSheetClass::instance();
        $spreadsheet_id = '1TcYnxOVNj49m8RIE1Dxgfw7PNobQ6q9iTeklB08FzaE';
        $values = new \Google_Service_Sheets_ValueRange();

        $body = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => [
                'addSheet' => [
                    'properties' => [
                        'title' => date('Y年m月d日')
                    ]
                ]
            ]
        ]);
        $response = $spreadsheet_service->spreadsheets->batchUpdate($spreadsheet_id, $body);

        $interviews = Interview::orderBy('date', 'asc')->where('available', -1)->with('hr_user:id,name,nickname')->with('st_user:id,name,nickname')->with('question1')->with('question2')->with('question3')->get();
        
        
        $result = [
            'ID', '氏名 (ニックネーム)', 'ユーザー状態', '流入経路', '卒業年度', '大学群', '志望企業タイプ', '登録日時', '大学名', '学部名', '学科名', '志望業界', '志望勤務地'  
        ];
        $values->setValues([
            'values' => $result
        ]);
        $params = ['valueInputOption' => 'USER_ENTERED'];
        $spreadsheet_service->spreadsheets_values->append(
            $spreadsheet_id,
            date('Y年m月d日').'!A1',
            $values,
            $params
        );
        
        $sts = User::get();
        foreach($sts as $st){
            $status = '未面接';
            if($st->status == 11){
                $status = '面接済み';
            }

            if($st->status != 2){
                $result = [
                    $st->id,
                    $st->name.' ('.$st->nickname.')',
                    $status,
                    $st->channel,

                    $st->graduate_year.'年卒',
                    $st->university_class,
                    $st->company_type,
                    $st->created_at,

                    $st->university,
                    $st->faculty,
                    $st->department,
                    $st->industry,
                    $st->workplace,
                ];
                $values->setValues([
                    'values' => $result
                ]);
                $params = ['valueInputOption' => 'USER_ENTERED'];
                $spreadsheet_service->spreadsheets_values->append(
                    $spreadsheet_id,
                    date('Y年m月d日').'!A2',
                    $values,
                    $params
                );
            }
                
        }

        return view('admin.comand.form_complete');
    }
}
