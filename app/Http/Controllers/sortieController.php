<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
class sortieController extends Controller
{
    public function add(){
        $listeProduit = Produit::all();
        return view('sortie.add',[ 'listeProduit'=>$listeProduit]);

    }


    public function persist(Request $request)
    {
        $request->validate([
            'produit' => 'required|exists:produits,id',
            'prix' => 'required|numeric|min:0',
            'dateSortie' => 'required|date',
            'quantite' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
            'nom_client' => 'required|string|max:255'
        ]);

        DB::beginTransaction();

        try {
            $produit = Produit::findOrFail($request->produit);

            if ($produit->stock < $request->quantite) {
                throw new \Exception("Stock insuffisant. Stock disponible : {$produit->stock}");
            }

            // Créer la sortie
            $sortie = Sortie::create([
                'produits_id' => $request->produit,
                'prix' => $request->prix,
                'dateSortie' => $request->dateSortie,
                'quantite' => $request->quantite,
                'user_id' => $request->user_id,
                'nom_client' => $request->nom_client
            ]);

            // Mettre à jour le stock
            $produit->decrement('stock', $request->quantite);

            DB::commit();

            return redirect()->route('sortie.list')
                ->with('success', 'Sortie enregistrée avec succès!')
                ->with('stock_restant', $produit->stock);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    // Méthode pour afficher la liste avec les statistiques
    // public function list()
    // {
    //     $listeSortie = Sortie::with(['produit', 'user'])
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(10);

    //     $statistiques = [
    //         'total_factures' => Sortie::count(),
    //         'total_quantite' => Sortie::sum('quantite'),
    //         'chiffre_affaires' => Sortie::sum('prix'),
    //         'clients_uniques' => Sortie::distinct('nom_client')->count('nom_client')
    //     ];

    //     return view('sortie.list', compact('listeSortie', 'statistiques'));
    // }

    public function list(){
       $listeSortie = Sortie::Simplepaginate(5);
       $listsum = Sortie::sum('quantite');
       $listeSortiecount = Sortie::count();

       $listeProduit = Produit::all();
        return view('sortie.list',['listeSortie'=>$listeSortie, 'listeProduit'=>$listeProduit,'listeSortiecount'=>$listeSortiecount,'listsum'=>$listsum]);
    }

    // public function persist(Request $request){

    //     $s = new Sortie();

    //     $s->produits_id = $request->produit;
    //     $s->prix = $request->prix;
    //     $s->dateSortie = $request->dateSortie;
    //     $s->quantite = $request->quantite;
    //     $s->user_id = $request->user_id;
    //     $s->nom_client = $request->nom_client;

    //     $pr = Produit::all()->find($s->produits_id);
    //     if ($pr->stock >= $request->quantite){
    //         $pr->stock -= $request->quantite;
    //         $pr->save();

    //         $s->save();

    //         $sms = "Opération réussie ...";
    //     }else{

    //         $sms = "L'opération a échoué ...";
    //     }
        
    //     $listeSortie = Sortie::paginate(5); // Change 10 to the number of items you want per page
    //     $listeProduit = Produit::paginate(5); // Change 10 to the number of items you want per page
        
    //     return view('sortie.list',['listeSortie'=>$listeSortie, 'listeProduit'=>$listeProduit, 'sms'=>$sms]);

    // }

    public function edit($id){
        $sortie = Sortie::find($id);
        $listeProduit = Produit::all();
        return view('sortie.editSortie', ['sortie'=>$sortie, 'listeProduit'=>$listeProduit]);
    }
    

    public function update(Request $request){
        $Sortie = Sortie::find($request->id);

        $Sortie->produits_id = $request->produit;
        $Sortie->quantite = $request->quantite;
        $Sortie->dateSortie = $request->dateSortie;
        $Sortie->prix = $request->prix;
        $Sortie->user_id = $request->user_id;
        //dd($Sortie);
        $Sortie->save();
        return redirect('/sortie/list');
    }

    public function destroy($id)
{
    $Sortie = Sortie::findOrFail($id);
    $Sortie->delete();

    return redirect()->route('listsortie')->with('success', 'Entree deleted successfully');
}

public function pdfsortie($id)
{
    $sortie = Sortie::findOrFail($id);
    
    // Utiliser DomPDF
    $pdf = Pdf::loadView('pdf.sortie', compact('sortie'));
    
    return $pdf->download('facture_'.$sortie->id.'.pdf');
}


}
