<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class sortieController extends Controller
{
    public function add(){
        $listeProduit = Produit::all();
        return view('sortie.add',[ 'listeProduit'=>$listeProduit]);

    }

    public function list(){
       $listeSortie = Sortie::Simplepaginate(5);
       $listeProduit = Produit::all();
        return view('sortie.list',['listeSortie'=>$listeSortie, 'listeProduit'=>$listeProduit]);
    }

    public function persist(Request $request){

        $s = new Sortie();

        $s->produits_id = $request->produit;
        $s->prix = $request->prix;
        $s->dateSortie = $request->dateSortie;
        $s->quantite = $request->quantite;
        $s->user_id = $request->user_id;
        $s->nom_client = $request->nom_client;

        $pr = Produit::all()->find($s->produits_id);
        if ($pr->stock >= $request->quantite){
            $pr->stock -= $request->quantite;
            $pr->save();

            $s->save();

            $sms = "Opération réussie ...";
        }else{

            $sms = "L'opération a échoué ...";
        }
        
        $listeSortie = Sortie::paginate(5); // Change 10 to the number of items you want per page
        $listeProduit = Produit::paginate(5); // Change 10 to the number of items you want per page
        
        return view('sortie.list',['listeSortie'=>$listeSortie, 'listeProduit'=>$listeProduit, 'sms'=>$sms]);

    }


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
    // Récupérez les données correspondant à l'ID de la sortie depuis votre modèle
    $sortie = Sortie::findOrFail($id); // Assurez-vous d'importer le modèle Sortie s'il n'est pas déjà importé

    // Si vous avez correctement récupéré les données, vous pouvez les passer à la vue
    $pdf = PDF::loadView('pdf.sortie', compact('sortie'));

    // Téléchargez le PDF avec un nom de fichier approprié
    return $pdf->download('sortie_'.$sortie->id.'.pdf');
}



}
