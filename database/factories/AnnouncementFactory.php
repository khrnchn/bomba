<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(10),
            'description' => $this->faker->text(255),
            'image_path' => $this->faker->text(),
            'file_path' => $this->faker->text(),
        ];
    }
}
