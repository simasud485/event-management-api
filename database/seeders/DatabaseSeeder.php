<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersSeedersTable::class,
            EventsSeedersTable::class,
            BookingsSeedersTable::class,
        ]);
    }
}
