<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Entree;
use App\Models\Sortie;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function dashboard()
{
    $listeSortiecount = Sortie::count();
    $listeCategorieCount = Categorie::count();
    $listeProduitCount = Produit::count();
    $listeEntreeCount = Entree::count();
    
    // Récupérer les 5 dernières activités (mix de tous les types)
    $activitesRecentes = [];
    
    // Dernier produit
    $dernierProduit = Produit::latest()->first();
    if ($dernierProduit) {
        $activitesRecentes[] = [
            'type' => 'produit',
            'message' => 'Produit ajouté: ' . $dernierProduit->libelle,
            'temps' => $dernierProduit->created_at->diffForHumans(),
            'couleur' => 'blue'
        ];
    }
    
    // Dernière facture
    $derniereSortie = Sortie::latest()->first();
    if ($derniereSortie) {
        $activitesRecentes[] = [
            'type' => 'facture',
            'message' => 'Facture #' . str_pad($derniereSortie->id, 5, '0', STR_PAD_LEFT),
            'temps' => $derniereSortie->created_at->diffForHumans(),
            'couleur' => 'green'
        ];
    }
    
    // Dernière entrée
    $derniereEntree = Entree::latest()->first();
    if ($derniereEntree) {
        $activitesRecentes[] = [
            'type' => 'entree',
            'message' => 'Entrée de stock enregistrée',
            'temps' => $derniereEntree->created_at->diffForHumans(),
            'couleur' => 'purple'
        ];
    }
    
    // Dernière catégorie
    $derniereCategorie = Categorie::latest()->first();
    if ($derniereCategorie) {
        $activitesRecentes[] = [
            'type' => 'categorie',
            'message' => 'Catégorie: ' . $derniereCategorie->nomCategorie,
            'temps' => $derniereCategorie->created_at->diffForHumans(),
            'couleur' => 'orange'
        ];
    }

    return view('dashboard', [
        'listeSortiecount' => $listeSortiecount,
        'listeCategorieCount' => $listeCategorieCount, 
        'listeProduitCount' => $listeProduitCount,
        'listeEntreeCount' => $listeEntreeCount,
        'activitesRecentes' => $activitesRecentes
    ]);
}



 public function visitor()
    {
        return view('dashboard.visitor', [
            'listeProduitCount' => Product::count(),
            'listeCategorieCount' => Category::count(),
            'listeEntreeCount' => Entree::count(),
            'listeSortiecount' => Sortie::count(),
            'activitesRecentes' => [], // Optionnel : recent activity
        ]);
    }
    
}
