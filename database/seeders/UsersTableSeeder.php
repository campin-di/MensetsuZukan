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
            'nickname' => 'YuU4i2',
            'name' => '吉田裕哉',
            'kana_name' => 'ヨシダユウヤ',
            'gender' => '1',
            'plan' => 'contributor',
            'graduate_year' => '2022',
            'major' => '2',
            'university_id' => 1,
            'faculty_id' => 3,
            'department_id' => 5,
            'status' => 10,
            'remember_token' => Str::random(10),
          ],
          [
            'email' => 'yuu.y0shi12@outlook.jp',
            'password' => Hash::make('password'),
            'nickname' => 'sonsan',
            'name' => '孫正義',
            'kana_name' => 'ソンマサヨシ',
            'gender' => '1',
            'plan' => 'contributor',
            'graduate_year' => '2023',
            'major' => '2',
            'university_id' => 1,
            'faculty_id' => 3,
            'department_id' => 5,
            'status' => 11,
            'remember_token' => Str::random(10),
          ],
        ]);

        \App\Models\User::factory(50)->create();
    }
}
