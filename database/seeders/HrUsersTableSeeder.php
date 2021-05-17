<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HrUsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
      DB::table('hr_users')->insert([
        [
          'email' => 'yuu.y0shi12@outlook.jp',
          'password' => Hash::make('password'),
          'name' => '吉田 裕太',
          'kana_name' => 'ヨシダ ユウタ',
          'gender' => 1,
          'plan' => 'hr',
          'company' => 'ソフトバンク株式会社',
          'company_type' => '大手',
          'industry' => 'IT・通信',
          'location' => '東京都',
          'stock_type' => '東証一部',
          'selection_phase' => '2次面接',
          'workplace' => '東京都',
          'summary' => '通信事業を行っております',
          'recruitment' => 'https://recruit.softbank.jp/graduate/',
          'site' => 'https://www.softbank.jp/',
          'introduction' => "私は大学で、〇〇部に所属し「入部当初に上級者でなくてもチームに貢献できることを後輩に伝える」という目標を掲げ、日々の活動に励んだ。 最初は周りに食らいつくことに必死で、試合に全く勝てない状況が続いた。",
          'pr' => "速さを意識し、効率化に努めています。プロジェクトの初期段階で必要な条件を細かく整理し、作業中に迷いやトラブルが生じないよう徹底しています。その結果、1カ月を予定していた開発プロジェクトを2週間で仕上げたこともあります。",
          'status' => 11,
          'remember_token' => Str::random(10),
        ],
        [
          'email' => 'yuu.yoshi12@outlook.jp',
          'password' => Hash::make('password'),
          'name' => '吉田 裕哉',
          'kana_name' => 'ヨシダ ユウヤ',
          'gender' => 1,
          'plan' => 'hr',
          'company' => 'ソフバン株式会社',
          'company_type' => '大手',
          'industry' => 'ディベロッパー',
          'location' => '東京都',
          'stock_type' => '東証二部',
          'selection_phase' => '1次面接',
          'workplace' => '東京都',
          'summary' => '通信事業を行っております',
          'recruitment' => 'https://recruit.softbank.jp/graduate/',
          'site' => 'https://www.softbank.jp/',
          'introduction' => "私は大学で、〇〇部に所属し「入部当初に上級者でなくてもチームに貢献できることを後輩に伝える」という目標を掲げ、日々の活動に励んだ。 最初は周りに食らいつくことに必死で、試合に全く勝てない状況が続いた。",
          'pr' => "速さを意識し、効率化に努めています。プロジェクトの初期段階で必要な条件を細かく整理し、作業中に迷いやトラブルが生じないよう徹底しています。その結果、1カ月を予定していた開発プロジェクトを2週間で仕上げたこともあります。",
          'status' => 10,
          'remember_token' => Str::random(10),
        ],
      ]);

      \App\Models\HrUser::factory(100)->create();
    }
}
