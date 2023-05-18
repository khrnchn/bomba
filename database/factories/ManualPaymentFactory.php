<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ManualPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManualPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ManualPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_path' => $this->faker->text(),
            'remarks' => $this->faker->text(255),
            'payment_method' => $this->faker->text(255),
        ];
    }
}
