<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(255),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'registration_start_date' => $this->faker->dateTime(),
            'registration_end_date' => $this->faker->dateTime(),
            'capacity' => $this->faker->randomNumber(0),
            'poster_path' => $this->faker->text(),
            'address' => $this->faker->address(),
            'world_division_id' => $this->faker->randomNumber(),
            'organizer_id' => \App\Models\Organizer::factory(),
        ];
    }
}
