<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'firstname' => 'Salaha',
            'lastname' => 'Sokhona',
            'email' => 'sokhona.salaha@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Sokhona'),
        ]);

        User::factory()->create([
            'firstname' => 'Ousmane',
            'lastname' => 'Sokhona',
            'email' => 'salaha.sokhona@outlook.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Sokhona'),
        ]);
    }
}
