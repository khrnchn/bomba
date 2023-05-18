<?php

namespace Database\Factories;

use App\Models\Feedback;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->text(),
            'rating' => $this->faker->text(255),
            'feedback_photo_path' => $this->faker->text(),
            'program_id' => \App\Models\Program::factory(),
            'participant_id' => \App\Models\Participant::factory(),
        ];
    }
}
