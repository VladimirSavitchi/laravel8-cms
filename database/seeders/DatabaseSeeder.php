<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call seeder to create an admin user
        $this->call([
            AdminUserSeeder::class,
        ]);

        // create 30 clients and 500 transactions for them
        Client::factory()->count(30)->create();
        Transaction::factory()->count(500)->create();
    }
}
