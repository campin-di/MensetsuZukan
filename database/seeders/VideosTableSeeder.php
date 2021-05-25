<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //0 ~ 4
      $usernameArray = [
        [ "nobita", "doraemon", "takeshi11", "shizukaChan", "dekisugikun" ],
        [ 1, 2, 3, 4, 5 ]
      ];
/*
      //0~34
      $urlArray = [
        //【就活】新聞も読まないクソザコ就活生向け「主要業界を理解する」アーカイブ【21卒】
        "628", "750", "932","1158", "1520",
        //【21卒】人気業界の現実を知る 深堀り編Vol.1【就活】
        "115", "253", "640", "2924","3529",
        //【21卒】学生の盲目的な大手志向を解消する業界研究LIVE 第2弾【就活】
        "77", "445", "1388", "2183", "2454",
        //【21卒】「コンサル・IT業界」を俺が全解説する やりたい事ない就活生は全員集合！ 【就活】
        "250", "360", "645", "815", "1200",
        //危ない会社予報士による主要30業種景気予測
        "1052", "1405", "1518", "2180", "2436",
        //【圧迫面接チャレンジ】コンサル志望 国公立大学生篇｜Vol.653
        "0", "42", "143", "196", "308",
        //【圧迫面接チャレンジ】(物流業界志望 関西学院篇）｜Vol.653
        "0", "68", "291", "604", "615",
        //裏事情】EC座談会（楽天/Amazon/アマゾンなど）｜Vol.644
        "0", "134", "192", "224", "270",
      ];

      //0 ~ 7
      $commonUrlArray = [
        "zAkK9qlCAbM" => [1, 2, 3, 4, 5],
        "p54Cg2N617A" => [6, 7, 8, 9, 10],
        "VOllbtgmSQA" => [11, 12, 13, 14, 15],
        "zJReZO1ND6c" => [16, 17, 18, 19, 20],
        "eqBA9wEeglg" => [21, 22, 23, 24, 25],
        "mjAXr6xA3ns" => [1, 3, 5, 7, 9],
        "mzlJjFuA4Dw" => [2, 4, 6, 8, 10],
        "yeK5dn1OPUc" => [2, 3, 5, 7, 11],
      ];

*/
      $commonUrlArray = [
        "551979139" => [628, 750, 932, 1158, 1520],
        "280567305" => [115, 253, 640, 2924, 3529],
        "449959341" => [77, 445, 1388, 2183, 2454],
        "517759809" => [250, 360, 645, 815, 1200],
        "546795671" => [1052, 1405, 1518, 2180, 2436],
        "179688764" => [0, 42, 143, 196, 308],
        "435943793" => [0, 68, 291, 604, 615],
        "372167667" => [0, 134, 192, 224, 270],
      ];


      //0 ~ 24
      $questionTextArray = [
        "自己紹介をお願いします。", "あなたの強み・長所を教えてください。", "あなたの弱み・短所を教えてください。", "学生時代で最も頑張ったことを教えてください。", "学生時代に出した成果を教えてください。",
        "課外活動の内容を教えてください。", "サークルやクラブ活動の内容を教えてください。", "リーダーシップを取った経験はありますか？", "まわりの方のあなたへの評価を教えてください。", "学生時代に学んだ事は何ですか。",
        "自分の大学生活を一言で表してください。", "成功体験を教えてください。", "失敗体験を教えてください。", "今まで一番感動したことを教えてください。", "今までで一番うれしかったことは何ですか。",
        "今までで一番悔しかったことは何ですか。", "あなたが一番長く続けてきたことは何ですか。", "○○大学に入った理由を教えてください。", "履修した中で、最も有意義な授業を教えてください。", "休学/留年した理由を教えてください。",
        "趣味を教えてください。", "尊敬する人を教えてください。", "今まで一番感動したことを教えてください。", "あなたの大切にしている言葉を教えてください。", "あなたの夢を教えてください。", "あなたの10年後の理想の姿を教えてください。",
      ];

      // 0 ~ 9
      $contentArray = [
        "到着も早く、きちんと梱包されていてとても良かったです。",
        "無理なお願いありがとうございました！どうしようかと思いましたが本当に助かりました！",
        "豹柄ほいので少し気になりますが良いです。カメラの上あたりが少しヒビがあったが返品が面倒臭いので我慢します。",
        "とても早い到着で梱包も問題ありませんでした！",
        "注文して届くまでとても早かった。又、とても大きな梱包で何が送って来たか、びっくりしたぐらいです。",
        "雪の影響で到着が遅かったです！商品は無事届きました！",
        "とても早い商品到着で満足です！又、良い商品を期待します！",
        "自分が日常使える語彙は限られている！との自覚から、類語辞典や慣用句辞典をいくつか持っています。今はやや文字数の多い慣用句に関心があって本書を購入しました。<br>
         行ったり来たりしながら絞り込んでいく作業を支えてくれる一冊です。",
        "とても早く到着し満足しました！梱包も問題有りませんでした！",
        "よく耳にする簡単な言葉が多く、総じて語彙が少ない感じがします。<br>
         それも１ページに、５～６個程度の言葉しかなく、基本的に学生向きかと思います。",
      ];

        foreach($commonUrlArray as $commonUrl => $startSecondArray){
          $random_date = [rand(2021, 2021), rand(1, 5), rand(1,24)];
          $zero4 = mt_rand(0, 4);
          $zero19 = mt_rand(0, 19);

          foreach ($startSecondArray as $startSecond) {
            $data = [
              'title' => $usernameArray[0][$zero4]. 'さんの「'. $questionTextArray[$zero19] . '」に対する答え方。',
              'thumbnail_src' => '/img/tmp.png',
              'vimeo_src' => 'https://player.vimeo.com/video/' . $commonUrl . '#t=' . $startSecond.'s?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
              'vimeo_id' => $commonUrl,
              'question_id' => $zero19+1,
              'st_id' => $usernameArray[1][$zero4],
              'hr_id' => mt_rand(1, 29),
              'score' => mt_rand(30, 100),
              'review' => $contentArray[mt_rand(0, 9)],
              'views' => mt_rand(0, 50),
              'good' => mt_rand(0, 50),
              'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
              'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            ];
            DB::table('videos')->insert([$data]);
            $zero19++;
          }
        }

        foreach($commonUrlArray as $commonUrl => $startSecondArray){
          $random_date = [rand(2019, 2020), rand(1, 12), rand(1,29)];
          $zero4 = mt_rand(0, 4);
          $zero19 = mt_rand(0, 19);

          foreach ($startSecondArray as $startSecond) {
            $data = [
              'title' => $usernameArray[0][$zero4]. 'さんの「'. $questionTextArray[$zero19] . '」に対する答え方。',
              'thumbnail_src' => '/img/tmp.png',
              'vimeo_src' => 'https://player.vimeo.com/video/' . $commonUrl . '#t=' . $startSecond.'s?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
              'vimeo_id' => $commonUrl,
              'question_id' => $zero19+1,
              'st_id' => $usernameArray[1][$zero4],
              'hr_id' => mt_rand(1, 29),
              'score' => mt_rand(30, 100),
              'review' => $contentArray[mt_rand(0, 9)],
              'views' => mt_rand(0, 50),
              'good' => mt_rand(0, 50),
              'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
              'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            ];
            DB::table('videos')->insert([$data]);
            $zero19++;
          }
        }
    }
}
