<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(2),
            'transactionable_id' => $this->faker->randomNumber(),
            'transactionable_type' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
            'transactionable_type' => $this->faker->randomElement([
                \App\Models\ManualPayment::class,
                \App\Models\OnlinePayment::class,
            ]),
            'transactionable_id' => function (array $item) {
                return app($item['transactionable_type'])->factory();
            },
        ];
    }
}
