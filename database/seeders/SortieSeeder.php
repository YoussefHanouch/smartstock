<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\Sortie;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SortieSeeder extends Seeder
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

        // Noms de produits
        $nom_client = [
            'Laptop',
            'Smartphone',
            'Tablette',
            'Téléviseur',
            'Casque sans fil',
            'Appareil photo',
            'Console de jeu',
            'Enceinte Bluetooth',
            'Imprimante',
            'Écouteurs sans fil',
        ];
 
         // Créer des sorties factices
         for ($i = 0; $i < 10; $i++) {
             Sortie::create([
                 'user_id' => $users->random(),
                 'produits_id' => $produits->random(),
                 'quantite' => rand(1, 20),
                 'prix' => rand(10, 500),
                 'dateSortie' => now()->subDays(rand(1, 30))->toDateString(),
                 'nom_client' => $nom_client[array_rand($nom_client)]
             ]);
         }
    }
}
