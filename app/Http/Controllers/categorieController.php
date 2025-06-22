<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class categorieController extends Controller
{
    public function add(){
        $listCategorie = Categorie::all();
        return view('categorie.add', ['listCategorie'=>$listCategorie]);

    }

    public function list(){
        $listCategorie = Categorie::all();
        return view('categorie.list', ['listCategorie'=>$listCategorie]);
    }

    public function persist(Request $request){
        $cat = new Categorie();
        $cat->nomCategorie = $request->categorie;
        $cat->save();

        return $this->list();
    }

    public function editCategory($id)
{
    // Récupérer la catégorie avec l'identifiant donné ($id)
    $category = Categorie::find($id);
    
    // Passer la catégorie à la vue d'édition
    return view('categorie.editCategorie')->with('category', $category);
}

public function updateCategory(Request $request, $id)
{
    // Validation des données
    $request->validate([
        'categorie' => 'required|string|max:255',
    ]);

    // Mettre à jour la catégorie
    $category = Categorie::find($id);
    $category->nomCategorie = $request->categorie;
    $category->save();

    // Redirection vers la liste des catégories avec un message de succès
    return redirect()->route('listcategorie')->with('success', 'Catégorie mise à jour avec succès');
}


public function delete($id)
{
    $categorie = Categorie::find($id);

    if ($categorie) {
        $categorie->delete();
        return redirect()->route('listcategorie')->with('success', 'Catégorie supprimée avec succès');
    }

    return redirect()->route('listcategorie')->with('error', 'La catégorie spécifiée n\'existe pas');
}


}
