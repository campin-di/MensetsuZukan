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
        'username' => $this->faker->unique()->userName,
        'email' => $this->faker->unique()->companyEmail,
        'password' => Hash::make('password'),
        'status' => 1,
        'company_id' => mt_rand(0, 99),
        'plan' => 'paid',
        'remember_token' => Str::random(10),
      ];
    }
}
