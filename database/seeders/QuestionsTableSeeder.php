<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Common\ReturnQuestionArrayClass;

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

      $questionArray = [
        '自己紹介',
        'ガクチカ',
        '１番の挑戦',
        '１番の失敗',
        '長所と短所',
        '好きなこと',
        '座右の銘',
        '未来のビジョン',
        '就活の軸',
        '自己PR',
        '仕事のモチベーション',
        '気になるニュース',
      ];

      foreach ($questionArray as $index => $question) {
        $data = [
          'name' => $questionArray[$index],
          'times' => 0,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ];

        DB::table('questions')->insert([$data]);
      }
    }
}
