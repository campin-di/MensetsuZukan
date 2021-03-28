<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InterviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //0 ~ 4
      $userIdArray = [ 1, 2, 3, 4, 5];

      //0~24
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
      ];

      //0 ~ 4
      $commonUrlArray = [ "zAkK9qlCAbM", "p54Cg2N617A", "VOllbtgmSQA", "zJReZO1ND6c", "eqBA9wEeglg" ];

      //0 ~ 24
      $theNumberOfQuestions = 24;

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
         本辞典の工夫は言いたい事柄を分類見出しから探し、一覧的に確かめることができるところにあります。また、巻末には収録慣用句が五十音で並んでいるので、ある慣用句を起点として似たような意味合いの句を探すこともできます。<br>
         行ったり来たりしながら絞り込んでいく作業を支えてくれる一冊です。",
        "とても早く到着し満足しました！梱包も問題有りませんでした！",
        "よく耳にする簡単な言葉が多く、総じて語彙が少ない感じがします。<br>
         それも１ページに、５～６個程度の言葉しかなく、基本的に学生向きかと思います。",
      ];


      for ($i = 0; $i < 100; $i++)
      {
        $random_date = [rand(2017, 2020), rand(1, 12), rand(1,31)];
        $zero24 = mt_rand(0, 24);
        $zero100 = mt_rand(50, 100);

        $data = [
          'st_id' => $userIdArray[mt_rand(0, 4)],
          'hr_id' => $userIdArray[mt_rand(0, 4)],
          'date' => $random_date[0].'-'.$random_date[1].'-'.$random_date[2],
          'password' => Hash::make('password'),
          'available' => 1,
          'url' => 'https://www.youtube.com/',
          'question_1_id' => mt_rand(1, $theNumberOfQuestions),
          'question_1_score' => $zero100,
          'question_3_review' => $reviewArray[mt_rand(0, 9)],
          'question_2_id' => mt_rand(1, $theNumberOfQuestions),
          'question_2_score' => $zero100,
          'question_2_review' => $reviewArray[mt_rand(0, 9)],
          'question_3_id' => mt_rand(1, $theNumberOfQuestions),
          'question_3_score' => $zero100,
          'question_3_review' => $reviewArray[mt_rand(0, 9)],
          'question_4_id' => mt_rand(1, $theNumberOfQuestions),
          'question_4_score' => $zero100,
          'question_4_review' => $reviewArray[mt_rand(0, 9)],
          'question_5_id' => mt_rand(1, $theNumberOfQuestions),
          'question_5_score' => $zero100,
          'question_5_review' => $reviewArray[mt_rand(0, 9)],
          'question_6_id' => mt_rand(1, $theNumberOfQuestions),
          'question_6_score' => $zero100,
          'question_6_review' => $reviewArray[mt_rand(0, 9)],
          'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
        ];

        DB::table('videos')->insert([$data]);
      }
    }

}
