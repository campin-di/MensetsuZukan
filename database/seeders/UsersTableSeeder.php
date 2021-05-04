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
            'plan' => 'contributor',
            'graduate_year' => '2023',
            'major' => '2',
            'university' => '岡山大学',
            'faculty' => '経済学部部',
            'department' => '経済学科',
            'status' => 10,
            'remember_token' => Str::random(10),
          ],
        ]);

        \App\Models\User::factory(50)->create();
    }
}
