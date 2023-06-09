<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InterviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $timeArray = [
        "8:00 - 9:00", "9:00 - 10:00", "10:00 - 11:00", "11:00 - 12:00",
        "12:00 - 13:00", "13:00 - 14:00", "14:00 - 15:00", "15:00 - 16:00",
        "16:00 - 17:00", "17:00 - 18:00", "18:00 - 19:00", "19:00 - 20:00",
        "20:00 - 21:00", "21:00 - 22:00"
      ];

      //0 ~ 4
      $commonUrlArray = [ "zAkK9qlCAbM", "p54Cg2N617A", "VOllbtgmSQA", "zJReZO1ND6c", "eqBA9wEeglg" ];

      //0 ~ 24
      $theNumberOfQuestions = 11;

      // 0 ~ 9
      $reviewArray = [
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

      for ($i = 0; $i < 6; $i++)
      {
        $random_date = [2021, rand(6, 7), rand(1,31)];

        $data = [
          'st_id' => mt_rand(1, 2),
          'hr_id' => mt_rand(1, 2),
          'date' => $random_date[0].'-'.$random_date[1].'-'.$random_date[2],
          'time' => $timeArray[mt_rand(0, 13)],
          'password' => Hash::make('password'),
          'available' => 1,
          'zoomUrl' => 'https://www.youtube.com/',
          'zoomId' => '123.3220.2981',
          'zoomPass' => '4$ka9kJai1#kaio$84',
          'question_1_id' => mt_rand(1, $theNumberOfQuestions),
          'question_1_logic' => mt_rand(1, 5),
          'question_1_personality' => mt_rand(1, 5),
          'question_2_id' => mt_rand(1, $theNumberOfQuestions),
          'question_2_logic' => mt_rand(1, 5),
          'question_2_personality' => mt_rand(1, 5),
          'question_3_id' => mt_rand(1, $theNumberOfQuestions),
          'question_3_logic' => mt_rand(1, 5),
          'question_3_personality' => mt_rand(1, 5),
          'review_good' => $reviewArray[mt_rand(0, 9)],
          'review_more' => $reviewArray[mt_rand(0, 9)],
          'review_message' => $reviewArray[mt_rand(0, 9)],
          'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
        ];

        DB::table('interviews')->insert([$data]);
      }
    }
}
