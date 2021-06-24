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
        [ "コービー", "ジョーダン", "ハチムラ", "ザイオン", "ハーデン", "ユータ", "ドンチッチ", "ルカ", "ドラモンド", "オータニサン"],
        [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
      ];

      $vimeoIdArray = [
        "557464608" => [628, 750, 932],
        "280567305" => [115, 253, 640],
        "449959341" => [77, 445, 1388],
        "557464608" => [250, 360, 645],
        "546795671" => [1052, 1405, 1518],
        "557464608" => [0, 42, 143],
        "435943793" => [0, 68, 291],
        "372167667" => [0, 134, 192],
      ];

      $vimeoIdArray2 = [
        "557464608" => [628, 750, 932],
        "442434665" => [115, 253, 640],
        "557464608" => [77, 445, 1388],
        "188801229" => [250, 360, 645],
        "557464608" => [1052, 1405, 1518],
        "293551991" => [0, 42, 143],
        "262806087" => [0, 68, 291],
        "437004631" => [0, 134, 192],
      ];

      //0 ~ 24
      $questionTextArray = [
        "自己紹介", "強み・長所", "弱み・短所", "ガクチカ", "学生時代の成果",
        "課外活動", "サークルやクラブ活動の内容", "リーダーシップ経験", "周囲からの評価", "学生時代に学んだ事",
        "大学生活を一言で表すと", "成功体験", "失敗体験", "一番感動したこと", "一番うれしかったこと",
        "一番悔しかったこと", "一番長く続けてきたこと", "大学を選んだ理由", "最もためになった授業", "休学/留年した理由",
        "趣味", "尊敬する人", "一番感動したこと", "大切にしている言葉", "夢",
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

      foreach($vimeoIdArray as $vimeoId => $startSecondArray){
        $random_date = [rand(2021, 2021), rand(1, 5), rand(1,24)];
        $zero9 = mt_rand(0, 9);
        $zero7 = mt_rand(0, 7);

        $logic = [mt_rand(3, 5), mt_rand(3, 5), mt_rand(3, 5)];
        $personality = [mt_rand(3, 5), mt_rand(3, 5), mt_rand(3, 5)];

        $score = $j = 0;
        foreach ($startSecondArray as $startSecond) {
          if($j==0){
            $weight = 2;
          } else {
            $weight = 4;
          }
          $score += $logic[$j]*$weight + $personality[$j]*$weight;
          $j++;
        }
      
        $index = 0;
        foreach ($startSecondArray as $startSecond) {
          $data = [
            'title' => $usernameArray[0][$zero9]. 'さんの「'. $questionTextArray[$zero7] . '」に対する答え方。',
            'thumbnail_name' => 'tmp.png',
            'thumbnail_path' => '/img/tmp.png',
            'vimeo_src' => 'https://player.vimeo.com/video/' . $vimeoId . '#t=' . $startSecond.'s?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
            'vimeo_id' => $vimeoId,
            'question_id' => $zero7+1,
            'st_id' => $usernameArray[1][$zero9],
            'hr_id' => mt_rand(1, 29),
            'logic' => $logic[$index],
            'personality' => $personality[$index],
            'score' => $score,
            'review' => $contentArray[mt_rand(0, 9)],
            'views' => mt_rand(0, 50),
            'good' => mt_rand(0, 50),
            'type' => 1,
            'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          ];
          DB::table('videos')->insert([$data]);
          $zero7++;
          $index++;
        }
      }

      foreach($vimeoIdArray2 as $vimeoId => $startSecondArray){
        $random_date = [rand(2021, 2021), rand(1, 5), rand(1,24)];
        $zero9 = mt_rand(0, 9);
        $zero7 = mt_rand(0, 7);

        $logic = [mt_rand(3, 5), mt_rand(3, 5), mt_rand(3, 5)];
        $personality = [mt_rand(3, 5), mt_rand(3, 5), mt_rand(3, 5)];

        $score = $j = 0;
        foreach ($startSecondArray as $startSecond) {
          if($j==0){
            $weight = 2;
          } else {
            $weight = 4;
          }
          $score += $logic[$j]*$weight + $personality[$j]*$weight;
          $j++;
        }
      
        $index = 0;
        foreach ($startSecondArray as $startSecond) {
          $data = [
            'title' => $usernameArray[0][$zero9]. 'さんの「'. $questionTextArray[$zero7] . '」に対する答え方。',
            'thumbnail_name' => 'tmp.png',
            'thumbnail_path' => '/img/tmp.png',
            'vimeo_src' => 'https://player.vimeo.com/video/' . $vimeoId . '#t=' . $startSecond.'s?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479',
            'vimeo_id' => $vimeoId,
            'question_id' => $zero7+1,
            'st_id' => $usernameArray[1][$zero9],
            'hr_id' => mt_rand(1, 29),
            'logic' => $logic[$index],
            'personality' => $personality[$index],
            'score' => $score,
            'review' => $contentArray[mt_rand(0, 9)],
            'views' => mt_rand(0, 50),
            'good' => mt_rand(0, 50),
            'type' => 1,
            'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          ];
          DB::table('videos')->insert([$data]);
          $zero7++;
          $index++;
        }
      }
    }
}
