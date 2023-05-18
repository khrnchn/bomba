<?php

namespace Database\Factories;

use App\Models\Staff;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'referral_code' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
            'station_id' => \App\Models\Station::factory(),
            'department_id' => \App\Models\Department::factory(),
        ];
    }
}
