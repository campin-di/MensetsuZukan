<?php

namespace Database\Factories;

use App\Models\HrUser;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class HrUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HrUser::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
    public function definition()
    {
      return [
        'name' => $this->faker->name,
        'email' => $this->faker->unique()->companyEmail,
        'password' => Hash::make('password'),
        'status' => 1,
        'company' => $this->faker->company,
        //'schedule_ids' => mt_rand(0, 30). ','. mt_rand(0, 30). ','. mt_rand(0, 30),
        'plan' => 'offer',
        'remember_token' => Str::random(10),
      ];
    }
}
