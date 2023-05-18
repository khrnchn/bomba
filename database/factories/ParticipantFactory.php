<?php

namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Participant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isMalaysian' => $this->faker->boolean(),
            'world_country_id' => $this->faker->randomNumber(),
            'world_division_id' => $this->faker->randomNumber(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
