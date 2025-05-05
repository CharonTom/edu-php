<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un utilisateur spécifique avec des valeurs définies
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Assure-toi que le mot de passe est crypté
            'signed_in' => false, // Utilisateur non signé par défaut
        ]);

        // Générer 10 utilisateurs aléatoires en utilisant la factory
        User::factory(10)->create();
    }
}
