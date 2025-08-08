<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'sokhona.salaha@gmail.com')->exists()) {
            User::factory()->create([
                'firstname' => 'Salaha',
                'lastname' => 'Sokhona',
                'email' => 'sokhona.salaha@gmail.com',
                'email_verified_at' => now(),
                'role_id' => 1, // Utilisateur administrateur
                'password' => bcrypt(env('ADMIN_PASSWORD')),
            ]);
        }

        if (!User::where('email', 'salaha.sokhona@outlook.com')->exists()) {
            User::factory()->create([
                'firstname' => 'Ousmane',
                'lastname' => 'Sokhona',
                'email' => 'salaha.sokhona@outlook.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Sokhona'),
            ]);
        }
    }
}
