<?php

namespace Database\Seeders;

use App\Models\OnlinePayment;
use Illuminate\Database\Seeder;

class OnlinePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OnlinePayment::factory()
            ->count(5)
            ->create();
    }
}
