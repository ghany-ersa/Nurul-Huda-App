<?php

namespace Database\Seeders;

use App\Models\Jamaah;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@nurul-huda.id',
            'password' => Hash::make('nurulhuda123'),
            'is_admin' => true,
        ]);

        // Jamaah::factory(10)->create();

        $this->call(MasjidContentSeeder::class);
        $this->call(WakafPembangunanTransactionSeeder::class);
    }
}
