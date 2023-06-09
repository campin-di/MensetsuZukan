<?php

namespace app\Common;
use Carbon\Carbon;
use Auth;

use App\Models\HrUser;

class RetUniversityClass
{
    public static function retUniversityClass($university)
    {
      $universityClassArray = [
        '東京一工' => ['東京大学', '京都大学', '一橋大学', '東京工業大学'],
        'その他旧帝大' => ['大阪大学', '名古屋大学', '東北大学', '北海道大学', '九州大学', '神戸大学'],
        '金岡千広・筑横千' => ['金沢大学', '岡山大学', '千葉大学', '広島大学', '筑波大学', '横浜国立大学'],
        '早慶上智・ICU' => ['慶應義塾大学', '早稲田大学', '慶應大学', '上智大学', '国際基督教大学'],
        'GMARCH' => ['学習院大学', '明治大学', '青山学院大学', '立教大学', '中央大学', '法政大学'],
        '関関同立' => ['関西大学', '関西学院大学', '同志社大学', '立命館大学'],
        '日東駒専' => ['日本大学', '専修大学', '駒澤大学', '東洋大学'],
        '産近甲龍' => ['京都産業大学', '近畿大学', '甲南大学', '龍谷大学'],
        'その他国公立大学' => [
          '旭川医科大学',
          '小樽商科大学',
          '帯広畜産大学',
          '北見工業大学',
          '北海道教育大学',
          '室蘭工業大学',
          '弘前大学',
          '岩手大学',
          '宮城教育大学',
          '秋田大学',
          '山形大学',
          '福島大学',
          '茨城大学',
          '筑波技術大学',
          '宇都宮大学',
          '群馬大学',
          '埼玉大学',
          'お茶の水女子大学',
          '電気通信大学',
          '東京医科歯科大学',
          '東京海洋大学',
          '東京外国語大学',
          '東京学芸大学',
          '東京芸術大学',
          '東京農工大学',
          '上越教育大学',
          '長岡技術科学大学',
          '新潟大学',
          '富山大学',
          '福井大学',
          '山梨大学',
          '信州大学',
          '岐阜大学',
          '静岡大学',
          '浜松医科大学',
          '愛知教育大学',
          '豊橋技術科学大学',
          '名古屋工業大学',
          '三重大学',
          '滋賀医科大学',
          '滋賀大学',
          '京都教育大学',
          '京都工芸繊維大学',
          '大阪教育大学',
          '兵庫教育大学',
          '奈良教育大学',
          '奈良女子大学',
          '和歌山大学',
          '鳥取大学',
          '島根大学',
          '山口大学',
          '徳島大学',
          '鳴門教育大学',
          '香川大学',
          '愛媛大学',
          '高知大学',
          '九州工業大学',
          '福岡教育大学',
          '佐賀大学',
          '長崎大学',
          '熊本大学',
          '大分大学',
          '宮崎大学',
          '鹿児島大学',
          '鹿屋体育大学',
          '琉球大学',
          '釧路公立大学',
          '公立千歳科学技術大学',
          '札幌医科大学',
          '札幌市立大学',
          '名寄市立大学',
          '公立はこだて未来大学',
          '青森県立保健大学',
          '青森公立大学',
          '岩手県立大学',
          '宮城大学',
          '秋田県立大学',
          '秋田公立美術大学',
          '山形県立保健医療大学',
          '山形県立米沢栄養大学',
          '会津大学',
          '福島県立医科大学',
          '茨城県立医療大学',
          '群馬県立県民健康科学大学',
          '群馬県立女子大学',
          '高崎経済大学',
          '前橋工科大学',
          '埼玉県立大学',
          '千葉県立保健医療大学',
          '東京都立大学',
          '神奈川県立保健福祉大学',
          '横浜市立大学',
          '三条市立大学',
          '長岡造形大学',
          '新潟県立看護大学',
          '新潟県立大学',
          '富山県立大学',
          '石川県立看護大学',
          '石川県立大学',
          '金沢美術工芸大学',
          '公立小松大学',
          '敦賀市立看護大学',
          '福井県立大学',
          '都留文科大学',
          '山梨県立大学',
          '公立諏訪東京理科大学',
          '長野県看護大学',
          '長野県立大学',
          '長野大学',
          '岐阜県立看護大学',
          '岐阜薬科大学',
          '静岡県立大学',
          '静岡県立農林環境専門職大学',
          '静岡文化芸術大学',
          '愛知県立芸術大学',
          '愛知県立大学',
          '名古屋市立大学',
          '三重県立看護大学',
          '滋賀県立大学',
          '京都市立芸術大学',
          '京都府立医科大学',
          '京都府立大学',
          '福知山公立大学',
          '大阪公立大学',
          '大阪市立大学',
          '大阪府立大学',
          '芸術文化観光専門職大学',
          '神戸市看護大学',
          '神戸市外国語大学',
          '兵庫県立大学',
          '奈良県立医科大学',
          '奈良県立大学',
          '和歌山県立医科大学',
          '公立鳥取環境大学',
          '島根県立大学',
          '岡山県立大学',
          '新見公立大学',
          '尾道市立大学',
          '広島市立大学',
          '県立広島大学',
          '福山市立大学',
          '山陽小野田市立山口東京理科大学',
          '下関市立大学',
          '山口県立大学',
          '香川県立保健医療大学',
          '愛媛県立医療技術大学',
          '高知県立大学',
          '高知工科大学',
          '北九州市立大学',
          '九州歯科大学',
          '福岡県立大学',
          '福岡女子大学',
          '長崎県立大学',
          '熊本県立大学',
          '大分県立看護科学大学',
          '宮崎県立看護大学',
          '宮崎公立大学',
          '沖縄県立看護大学',
          '沖縄県立芸術大学',
          '名桜大学',
        ],
      ];

      $university = explode('大学院', $university)[0];

      foreach($universityClassArray as $universityClass => $universityArray){
        if(in_array($university, $universityArray)){
          return $universityClass;          
        }
      }
      return 'その他私立大学';
    }
}
