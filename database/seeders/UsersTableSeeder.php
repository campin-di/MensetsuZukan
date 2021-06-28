<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          [
            'email' => 'yuu.yoshi12@outlook.jp',
            'password' => Hash::make('password'),
            'nickname' => 'よっしー',
            'name' => '吉田 裕哉',
            'kana_name' => 'ヨシダ ユウヤ',
            'gender' => '1',
            'plan' => 'contributor',
            'graduate_year' => '2022',
            'major' => '2',
            'university' => '岡山大学',
            'faculty' => '工学部',
            'department' => '情報系学科',

            'company_type' => '大手',
            'industry' => 'IT・通信',
            'jobtype' => 'セキュリティエンジニア',
            'workplace' => '東京都',
            'start_time' => '直近1ヶ月以内',
            'english_level' => 'ディベートレベル',
            'toeic' => '700 ~ 749',
            'introduction' => 'IT業界の方と面接経験を積みたいです。ビジバシ指摘していただければ幸いです！よろしくお願いいたします。',
            'strengths' => '学生時代に上場企業を立ち上げたことが強みです。',
            'gakuchika' => 'ムクドナルドというハンバーガーショップを全国に200万店舗立ち上げたことです。フランチャイズを使わず、全て直営店として運営していたため、地方の店長や社員のモチベーション管理などに苦労しましたが、全国共通の業務システム・評価制度を導入してからは、モチベーション管理がしやすくなり、業績の前年比25%アップにも繋がるなどの効果がありました。',
            'personality' => 'チャレンジ精神旺盛な性格です！',

            'status' => 11,
            'remember_token' => Str::random(10),
          ],
          [
            'email' => 'kinta@outlook.jp',
            'password' => Hash::make('password'),
            'nickname' => 'キンタ',
            'name' => 'ゴダール 金太郎',
            'kana_name' => 'ゴダール キンタロウ',
            'gender' => '1',
            'plan' => 'audience',
            'graduate_year' => '2023',
            'major' => '2',
            'university' => '岡山大学',
            'faculty' => '経済学部部',
            'department' => '経済学科',

            'company_type' => '大手',
            'industry' => 'IT・通信',
            'jobtype' => 'セキュリティエンジニア',
            'workplace' => '東京都',
            'start_time' => '直近1ヶ月以内',
            'english_level' => 'ディベートレベル',
            'toeic' => '700 ~ 749',
            'introduction' => 'IT業界の方と面接経験を積みたいです。ビジバシ指摘していただければ幸いです！よろしくお願いいたします。',
            'strengths' => '学生時代に上場企業を立ち上げたことが強みです。',
            'gakuchika' => 'ムクドナルドというハンバーガーショップを全国に200万店舗立ち上げたことです。フランチャイズを使わず、全て直営店として運営していたため、地方の店長や社員のモチベーション管理などに苦労しましたが、全国共通の業務システム・評価制度を導入してからは、モチベーション管理がしやすくなり、業績の前年比25%アップにも繋がるなどの効果がありました。',
            'personality' => 'チャレンジ精神旺盛な性格です！',

            'status' => 10,
            'remember_token' => Str::random(10),
          ],
        ]);

        //\App\Models\User::factory(50)->create();
    }
}
