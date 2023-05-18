<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\OnlinePayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class OnlinePaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OnlinePayment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [];
    }
}
