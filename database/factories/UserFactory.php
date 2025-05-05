<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Le nom du modèle correspondant à la factory.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Définir l'état par défaut de la factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Assure-toi que le mot de passe est crypté
            'signed_in' => $this->faker->boolean(50), // Génère aléatoirement true ou false
        ];
    }
}
