<?php

namespace Database\Seeders;

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
        "nobita", "doraemon", "takeshi11", "shizukaChan", "dekisugikun"
      ];

      //0~24
      $urlArray = [
        //【就活】新聞も読まないクソザコ就活生向け「主要業界を理解する」アーカイブ【21卒】
        "https://www.youtube.com/watch?v=zAkK9qlCAbM&t=628s",
        "https://www.youtube.com/watch?v=zAkK9qlCAbM&t=750s",
        "https://www.youtube.com/watch?v=zAkK9qlCAbM&t=932s",
        "https://www.youtube.com/watch?v=zAkK9qlCAbM&t=1008s",
        "https://www.youtube.com/watch?v=zAkK9qlCAbM&t=1465s",
        //【21卒】人気業界の現実を知る 深堀り編Vol.1【就活】
        "https://www.youtube.com/watch?v=p54Cg2N617A&t=115s",
        "https://www.youtube.com/watch?v=p54Cg2N617A&t=253s",
        "https://www.youtube.com/watch?v=p54Cg2N617A&t=404s",
        "https://www.youtube.com/watch?v=p54Cg2N617A&t=640s",
        "https://www.youtube.com/watch?v=p54Cg2N617A&t=640s",
        //【21卒】学生の盲目的な大手志向を解消する業界研究LIVE 第2弾【就活】
        "https://www.youtube.com/watch?v=VOllbtgmSQA&t=77s",
        "https://www.youtube.com/watch?v=VOllbtgmSQA&t=1388s",
        "https://www.youtube.com/watch?v=VOllbtgmSQA&t=3338s",
        "https://www.youtube.com/watch?v=VOllbtgmSQA&t=4810s",
        "https://www.youtube.com/watch?v=VOllbtgmSQA&t=5582s",
        //【21卒】「コンサル・IT業界」を俺が全解説する やりたい事ない就活生は全員集合！ 【就活】
        "https://www.youtube.com/watch?v=zJReZO1ND6c&t=250s",
        "https://www.youtube.com/watch?v=zJReZO1ND6c&t=360s",
        "https://www.youtube.com/watch?v=zJReZO1ND6c&t=645s",
        "https://www.youtube.com/watch?v=zJReZO1ND6c&t=1200s",
        "https://www.youtube.com/watch?v=zJReZO1ND6c&t=1834s",
        //危ない会社予報士による主要30業種景気予測
        "https://www.youtube.com/watch?v=eqBA9wEeglg&t=1052s",
        "https://www.youtube.com/watch?v=eqBA9wEeglg&t=1300s",
        "https://www.youtube.com/watch?v=eqBA9wEeglg&t=1518s",
        "https://www.youtube.com/watch?v=eqBA9wEeglg&t=2180s",
        "https://www.youtube.com/watch?v=eqBA9wEeglg&t=4530s",
      ];

      //0 ~ 4
      $commonUrlArray = [
        "https://www.youtube.com/watch?v=zAkK9qlCAbM",
        "https://www.youtube.com/watch?v=p54Cg2N617A",
        "https://www.youtube.com/watch?v=VOllbtgmSQA",
        "https://www.youtube.com/watch?v=zJReZO1ND6c",
        "https://www.youtube.com/watch?v=eqBA9wEeglg",
      ];

      //0 ~ 24
      $questionArray = [
        "自己紹介をお願いします。", "あなたの強み・長所を教えてください。", "あなたの弱み・短所を教えてください。", "学生時代で最も頑張ったことを教えてください。", "学生時代に出した成果を教えてください。",
        "課外活動の内容を教えてください。", "サークルやクラブ活動の内容を教えてください。", "リーダーシップを取った経験はありますか？", "まわりの方のあなたへの評価を教えてください。", "学生時代に学んだ事は何ですか。",
        "自分の大学生活を一言で表してください。", "成功体験を教えてください。", "失敗体験を教えてください。", "今まで一番感動したことを教えてください。", "今までで一番うれしかったことは何ですか。",
        "今までで一番悔しかったことは何ですか。", "あなたが一番長く続けてきたことは何ですか。", "○○大学に入った理由を教えてください。", "履修した中で、最も有意義な授業を教えてください。", "休学/留年した理由を教えてください。",
        "趣味を教えてください。", "尊敬する人を教えてください。", "今まで一番感動したことを教えてください。", "あなたの大切にしている言葉を教えてください。", "あなたの夢を教えてください。",
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
         本辞典の工夫は言いたい事柄を分類見出しから探し、一覧的に確かめることができるところにあります。また、巻末には収録慣用句が五十音で並んでいるので、ある慣用句を起点として似たような意味合いの句を探すこともできます。<br>
         行ったり来たりしながら絞り込んでいく作業を支えてくれる一冊です。",
        "とても早く到着し満足しました！梱包も問題有りませんでした！",
        "よく耳にする簡単な言葉が多く、総じて語彙が少ない感じがします。<br>
         それも１ページに、５～６個程度の言葉しかなく、基本的に学生向きかと思います。",
      ];

      $zero24 = mt_rand(0, 24);

      for ($i = 0; $i < 1000; $i++)
      {
        $data = [
          'title' => $usernameArray[mt_rand(0, 4)]. 'さんの「'. $questionArray[$zero24] . '」に対する答え方。',
          'url' => $urlArray[$zero24],
          'common_url' => $commonUrlArray[round($zero24/5)],
          'question' => $questionArray[$zero24],
          'st_id' => mt_rand(1, 5),
          'hr_id' => mt_rand(1, 5),
          'score' => mt_rand(30, 100),
          'review' => $contentArray[mt_rand(0, 9)],
          'views' => mt_rand(0, 50),
          'good' => mt_rand(0, 50),
        ];

        DB::table('videos')->insert([$data]);
      }
      /*
      DB::table('videos')->insert([
        [
          'title' => $usernameArray[mt_rand(0, 4)]. 'さんの「'. $questionArray[$zero24] . '」に対する答え方。',
          'url' => $urlArray[$zero24],
          'common_url' => round($commonUrlArray[$zero24]/5),
          'question' => $questionArray[$zero24],
          'st_id' => mt_rand(1, 5),
          'hr_id' => mt_rand(1, 5),
          'score' => mt_rand(30, 100),
          'review' => $content_array[mt_rand(0, 9)],
          'views' => mt_rand(0, 50),
          'good' => mt_rand(0, 50),
        ],
      ]);
      */
    }
}
