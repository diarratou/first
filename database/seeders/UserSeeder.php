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
        //

        // \App\Models\User::factory()->create([

        // ]);

        if (User::where('role', 'gestionnaire')->count() == 0) {
            User::factory()->create([
                'name' => 'PapeSam',
                'email' => 'papesam@ipp.com',
                'password' => bcrypt('passer123'), // Assure-toi de changer ce mot de passe
                'role' => 'gestionnaire',
            ]);
        }
    }
}
