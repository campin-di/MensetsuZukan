<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\GoogleSheetClass;

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
}
