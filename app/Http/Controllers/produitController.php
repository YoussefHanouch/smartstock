<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use http\Client\Response;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class produitController extends Controller
{


   public function list(){
    $listproduit = Produit::simplePaginate(5);
    $produitCount = Produit::count(); // Variable différente pour le count
    $listcategorie = Categorie::all();
    
    return view('produit.list', [
        'listproduit' => $listproduit,
        'produitCount' => $produitCount,
        'listcategorie' => $listcategorie
    ]);
}


    public function add(){
        $listcategorie = Categorie::all();
        return view('produit.add', ['listcategorie'=>$listcategorie]);
     }

     
    public function  persist(Request $request){
        $p = new Produit();
        $p->libelle = $request->libelle;
        $p->categories_id = $request->categorie;
        $p->stock = $request->stock;
        $p->user_id = $request->user_id;

        $p->save();
        return $this->list();
    }


    public function edit($id){
        $produit = Produit::find($id);
        $listcategorie = Categorie::all();
        //var_dump($produit);
        return view('produit.edit', ['listcategorie'=>$listcategorie, 'produit'=>$produit] );

    }

    public function update(Request $request){

        $p = Produit::find($request->id);
        $p->libelle = $request->libelle;
        $p->stock = $request->stock;
        $p->categories_id = $request->categorie;
        $p->user_id = $request->user_id;
        $p->save();
        return redirect('/produit/list');
    }

    public function delete($id){
        $produit = Produit::find($id);
    
        if ($produit) {
            $produit->delete();
            return redirect('/produit/list')->with('success', 'Le produit a été supprimé avec succès.');
        } else {
            return redirect('/produit/list')->with('error', 'Le produit que vous essayez de supprimer n\'existe pas.');
        }
    }


// Dans votre contrôleur

public function pdfListeProduit(){
    // Récupérer les données sans utiliser la relation Eloquent
    $produits = Produit::all();
    $categories = Categorie::all()->keyBy('id'); // Crée un tableau indexé par ID
    // return $produits;
    $pdf = Pdf::loadView('pdf.produit', compact('produits', 'categories'));
    return $pdf->download('liste_produits.pdf');
}


public function exportProduitsCSV(){
    $produits = Produit::with('categorie')->get();
    
    $fileName = 'produits_' . date('Y-m-d') . '.csv';
    
    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $callback = function() use ($produits) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['ID', 'Nom', 'Catégorie', 'Stock', 'Statut']);
        
        foreach ($produits as $produit) {
            $statut = $produit->stock > 20 ? 'En stock' : ($produit->stock > 0 ? 'Stock faible' : 'Rupture');
            fputcsv($file, [
                $produit->id,
                $produit->libelle,
                $produit->categorie->nomCategorie ?? 'N/A',
                $produit->stock,
                $statut
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}
