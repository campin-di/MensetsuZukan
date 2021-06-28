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
          'email' => 'yuu.yoshi12@outlook.jp',
          'password' => Hash::make('password'),
          'name' => '吉田 裕哉',
          'kana_name' => 'ヨシダ ユウヤ',
          'nickname' => 'ヨッシー',
          'gender' => 1,
          'plan' => 'hr',
          'company' => '株式会社ぱむ',
          'company_type' => 'ベンチャー',
          'industry' => 'IT・通信',
          'location' => '東京都',
          'stock_type' => '非上場',
          'selection_phase' => '1次面接',
          'workplace' => '東京都',
          'summary' => '各種広告・販促物・会社案内等のデザイン企画・制作・印刷 Webサイト構築、デザイン制作、サイト運営 動画コンテンツの企画、制作 インターネット、モバイル、アフィリエイト等の広告代理 新聞、雑誌、コミュニティ紙等の広告代理店頭販売促進支援、プロモーション企画 eコマース支援、企画・設計・運用 eコマースコンテンツ開発・運営及び通販事業 モバイルコンテンツ開発、モバイルシステム及びプログラム開発・運用・保守業 など',
          'recruitment' => 'https://www.pampam.co.jp/recruit/referral/job-list',
          'site' => 'https://pam-info.jp/',
          'introduction' => "設定されていません。",
          'pr' => "設定されていません。",
          'status' => 11,
          'remember_token' => Str::random(10),
        ],
        [
          'email' => 'yuu.y0shi12@outlook.jp',
          'password' => Hash::make('password'),
          'name' => 'ゴダール 金太郎',
          'kana_name' => 'ゴダール キンタロウ',
          'nickname' => 'きんちゃん',
          'gender' => 1,
          'plan' => 'hr',
          'company' => '株式会社ぱむ',
          'company_type' => 'ベンチャー',
          'industry' => 'IT・通信',
          'location' => '東京都',
          'stock_type' => '非上場',
          'selection_phase' => '1次面接',
          'workplace' => '東京都',
          'summary' => '各種広告・販促物・会社案内等のデザイン企画・制作・印刷 Webサイト構築、デザイン制作、サイト運営 動画コンテンツの企画、制作 インターネット、モバイル、アフィリエイト等の広告代理 新聞、雑誌、コミュニティ紙等の広告代理店頭販売促進支援、プロモーション企画 eコマース支援、企画・設計・運用 eコマースコンテンツ開発・運営及び通販事業 モバイルコンテンツ開発、モバイルシステム及びプログラム開発・運用・保守業 など',
          'recruitment' => 'https://www.pampam.co.jp/recruit/referral/job-list',
          'site' => 'https://pam-info.jp/',
          'introduction' => "設定されていません。",
          'pr' => "設定されていません。",
          'status' => 10,
          'remember_token' => Str::random(10),
        ],
      ]);

      //\App\Models\HrUser::factory(100)->create();
    }
}
