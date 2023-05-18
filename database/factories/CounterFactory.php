<?php

namespace Database\Factories;

use App\Models\Counter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CounterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Counter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(255),
            'isCheckIn' => $this->faker->boolean(),
            'program_id' => \App\Models\Program::factory(),
        ];
    }
}
