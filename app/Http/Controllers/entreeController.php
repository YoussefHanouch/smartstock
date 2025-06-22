<?php

namespace App\Http\Controllers;

use App\Models\Entree;
use App\Models\Produit;
use Illuminate\Http\Request;

class entreeController extends Controller
{
    public function add(){
        return view('entree.add');
    }

    public function list(){
        $listentree = Entree::Simplepaginate(5);
        $listproduit = Produit::all();
        return view('entree.list', ['listentree'=>$listentree, 'listproduit'=>$listproduit]);
    }

    public function persist(Request $request){

        $e = new Entree();
        $e->produits_id = $request->produit;
        $e->quantite = $request->quantite;
        $e->dateEntree = $request->dateEntree;
        $e->prix = $request->prix;
        $e->user_id = $request->user_id;

        //Mettre à jour la quantité en stock sur Produit
        $pr = Produit::all()->find($e->produits_id);
        $pr->stock += $request->quantite;
        $pr->save();

        $e->save();
        return redirect('/entree/list');
    }

    public function edit($id){
        $entree = Entree::find($id);
        $listproduit = Produit::all();
        return view('entree.edit', ['entree'=>$entree, 'listproduit'=>$listproduit]);
    }

    public function update(Request $request){
        $entree = Entree::find($request->id);

        $entree->produits_id = $request->produit;
        $entree->quantite = $request->quantite;
        $entree->dateEntree = $request->dateEntree;
        $entree->prix = $request->prix;
        $entree->user_id = $request->user_id;
        //dd($entree);
        $entree->save();
        return redirect('/entree/list');
    }

    public function destroy($id)
{
    $entree = Entree::findOrFail($id);
    $entree->delete();

    return redirect()->route('listentree')->with('success', 'Entree deleted successfully');
}




    //========================================  API  ==========================================================



    // API get list entree
    public function getAll(){
        return Entree::all();
    }

    // API get entree by id
    public function getEntreeById($id){
        $e = Entree::find($id);
        if (is_null($e)){
            return \response()->json(['status'=>200, "message"=>"Cette entrée n'existe pas "]);
        }else{
            return \response()->json([$e, "message"=>"Voila ton entrée"]);
        }
    }
    // API update entree
    public function updateEntree(Request $request, $id){
        $entree = Entree::find($id);

        $entree->produits_id = $request->produit;
        $entree->quantite = $request->quantite;
        $entree->dateEntree = $request->dateEntree;
        $entree->prix = $request->prix;
        $entree->user_id = $request->user_id;
        $result = $entree->save();

        if ($result){
            return \response()->json(['status'=>200, 'message'=>'Entrée modifier']);
        }else{
            return \response()->json(['status'=>200, 'message'=>'Erreur lors de la modification']);
        }
    }

    // API add entree
    public function addEntree(Request $request){

        $e = new Entree();
        $e->produits_id = $request->produit;
        $e->quantite = $request->quantite;
        $e->dateEntree = $request->dateEntree;
        $e->prix = $request->prix;
        $e->user_id = $request->user_id;

        $pr = Produit::all()->find($e->produits_id);
        $pr->stock += $request->quantite;
        $result1 = $pr->save();
        $result2 = $e->save();

        if($result1 && $result2){
            return \response()->json(['status'=>200, 'message'=>'Opération réussie']);
        }

    }
}
