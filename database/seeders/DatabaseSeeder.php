<?php

namespace Database\Seeders;

use Database\Seeders\ProduitSeeder as SeedersProduitSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use ProduitSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorieSeeder::class,
             UserSeeder::class,
            SeedersProduitSeeder::class,
            EntreeSeeder::class,
            SortieSeeder::class,
        ]);
    }
}
