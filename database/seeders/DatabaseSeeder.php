<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            NagariDataSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin Nagari',
            'email' => 'admin@nagaridigital.web.id',
            'password' => bcrypt('admin123'),
        ]);
    }
}
