<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('password'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AnnouncementSeeder::class);
        $this->call(CheckSeeder::class);
        $this->call(CounterSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(ManualPaymentSeeder::class);
        $this->call(OnlinePaymentSeeder::class);
        $this->call(OrganizerSeeder::class);
        $this->call(ParticipantSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(ReferenceSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(StationSeeder::class);
        $this->call(TransactionSeeder::class);
        $this->call(UserSeeder::class);

        Artisan::call('world:init');
    }
}
