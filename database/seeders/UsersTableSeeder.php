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
            'line_id' => '00000000000',
            'nickname' => 'あい',
            'name' => '出井　愛',
            'kana_name' => 'デイ　アイ',
            'gender' => '1',
            'plan' => 'admin',
            'graduate_year' => '2022',
            'major' => '2',
            'university' => '岡山大学',
            'university_class' => '金岡千広・筑横千',
            'faculty' => '工学部',
            'department' => '情報系学科',

            'company_type' => '大手',
            'industry' => 'IT・通信',
            'jobtype' => 'セキュリティエンジニア',
            'workplace' => '東京都',
            'start_time' => '大学2年・後期',
            'english_level' => 'ディベートレベル',
            'toeic' => '700 ~ 749',

            'status' => 11,
            'remember_token' => Str::random(10),
          ],
          [
            'email' => 'kinta@outlook.jp',
            'password' => Hash::make('password'),
            'line_id' => '00000000001',
            'nickname' => 'キンタ',
            'name' => 'ゴダール 金太郎',
            'kana_name' => 'ゴダール キンタロウ',
            'gender' => '1',
            'plan' => 'audience',
            'graduate_year' => '2023',
            'major' => '2',
            'university' => '岡山大学',
            'university_class' => '金岡千広・筑横千',
            'faculty' => '経済学部',
            'department' => '経済学科',

            'company_type' => '大手',
            'industry' => 'IT・通信',
            'jobtype' => 'マーケティング',
            'workplace' => '東京都',
            'start_time' => '大学2年・後期',
            'english_level' => 'ディベートレベル',
            'toeic' => '700 ~ 749',

            'status' => 10,
            'remember_token' => Str::random(10),
          ],
        ]);

        //\App\Models\User::factory(50)->create();
    }
}
