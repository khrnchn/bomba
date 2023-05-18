<?php

namespace Database\Seeders;

use App\Models\ManualPayment;
use Illuminate\Database\Seeder;

class ManualPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ManualPayment::factory()
            ->count(5)
            ->create();
    }
}
