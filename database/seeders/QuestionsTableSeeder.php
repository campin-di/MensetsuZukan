<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $random_date = [rand(2017, 2020), rand(1, 12), rand(1,31)];

      //0 ~ 24
      $questionArray = [
        "自己紹介をお願いします。", "あなたの強み・長所を教えてください。", "あなたの弱み・短所を教えてください。", "学生時代で最も頑張ったことを教えてください。", "学生時代に出した成果を教えてください。",
        "課外活動の内容を教えてください。", "サークルやクラブ活動の内容を教えてください。", "リーダーシップを取った経験はありますか？", "まわりの方のあなたへの評価を教えてください。", "学生時代に学んだ事は何ですか。",
        "自分の大学生活を一言で表してください。", "成功体験を教えてください。", "失敗体験を教えてください。", "今まで一番感動したことを教えてください。", "今までで一番うれしかったことは何ですか。",
        "今までで一番悔しかったことは何ですか。", "あなたが一番長く続けてきたことは何ですか。", "○○大学に入った理由を教えてください。", "履修した中で、最も有意義な授業を教えてください。", "休学/留年した理由を教えてください。",
        "趣味を教えてください。", "尊敬する人を教えてください。", "今まで一番感動したことを教えてください。", "あなたの大切にしている言葉を教えてください。", "あなたの夢を教えてください。",
      ];

      foreach ($questionArray as $index => $question) {
        $data = [
          'name' => $questionArray[$index],
          'times' => mt_rand(1, 30),
          'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
        ];

        DB::table('questions')->insert([$data]);
      }
    }
}
