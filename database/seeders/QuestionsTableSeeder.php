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
        "自己紹介", "強み・長所", "弱み・短所", "ガクチカ", "学生時代の成果",
        "課外活動", "サークルやクラブ活動の内容", "リーダーシップ経験", "周囲からの評価", "学生時代に学んだ事",
        "大学生活を一言で表すと", "成功体験", "失敗体験", "一番感動したこと", "一番うれしかったこと",
        "一番悔しかったこと", "一番長く続けてきたこと", "大学を選んだ理由", "最もためになった授業", "休学/留年した理由",
        "趣味", "尊敬する人", "一番感動したこと", "大切にしている言葉", "夢",
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
