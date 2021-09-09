<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Common\GoogleSheetClass;
use App\Models\User;
use App\Models\Interview;
use App\Models\Video;

class UserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:userdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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
        return 0;
    }
}
