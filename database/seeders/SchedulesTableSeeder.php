<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      {
        for($i = 1; $i <= 40; $i++) {
          $random_date = [2021, mt_rand(1, 6), mt_rand(1,29)];
          $data = [
            'hr_id' => mt_rand(1, 29),
            'date' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'nine' => mt_rand(0, 1),
            'ten' => mt_rand(0, 1),
            'eleven' => mt_rand(0, 1),
            'twelve' => mt_rand(0, 1),
            'thirteen' => mt_rand(0, 1),
            'fourteen' => mt_rand(0, 1),
            'fifteen' => mt_rand(0, 1),
            'sixteen' => mt_rand(0, 1),
            'seventeen' => mt_rand(0, 1),
            'eighteen' => mt_rand(0, 1),
            'nineteen' => mt_rand(0, 1),
            'twenty' => mt_rand(0, 1),
            'twentyone' => mt_rand(0, 1),
            'updated_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
            'created_at' => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
          ];

          DB::table('schedules')->insert([$data]);
        }
      }
    }
}
