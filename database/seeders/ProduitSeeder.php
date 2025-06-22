<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer quelques utilisateurs et catégories
        $users = User::pluck('id');
        $categories = Categorie::pluck('id');

        // Noms de produits
        $nomsProduits = [
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

        // Créer 10 produits avec des noms de produits aléatoires
        for ($i = 0; $i < 10; $i++) {
            Produit::create([
                'user_id' => $users->random(),
                'categories_id' => $categories->random(),
                'libelle' => $nomsProduits[array_rand($nomsProduits)],
                'stock' => rand(1, 100),
            ]);
        }
    }
}
