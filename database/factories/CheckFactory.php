<?php

namespace Database\Factories;

use App\Models\Check;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Check::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isCheckIn' => $this->faker->boolean(),
            'staff_id' => \App\Models\Staff::factory(),
            'counter_id' => \App\Models\Counter::factory(),
            'participant_id' => \App\Models\Participant::factory(),
            'program_id' => \App\Models\Program::factory(),
        ];
    }
}
