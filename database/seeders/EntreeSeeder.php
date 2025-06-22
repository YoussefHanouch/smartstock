<?php

namespace Database\Seeders;

use App\Models\Entree;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Récupérer quelques utilisateurs et produits
         $users = User::pluck('id');
         $produits = Produit::pluck('id');
 
         // Créer des entrées factices
         for ($i = 0; $i < 10; $i++) {
             Entree::create([
                 'user_id' => $users->random(),
                 'produits_id' => $produits->random(),
                 'quantite' => rand(1, 50),
                 'prix' => rand(10, 1000),
                 'dateEntree' => now()->subDays(rand(1, 30))->toDateString(),
             ]);
         }
     
    }
}
