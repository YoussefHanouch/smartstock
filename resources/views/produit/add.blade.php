@extends('layouts.app')

@section('prod')
@section('content')
<style>
  /* Style pour le formulaire */
form {
    max-width: 600px; /* Largeur maximale du formulaire */
    margin: 0 auto; /* Centrer le formulaire horizontalement */
    padding: 20px; /* Ajouter de l'espace à l'intérieur du formulaire */
    border: 1px solid #ddd; /* Bordure grise */
    border-radius: 10px; /* Coins arrondis */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre pour un effet de profondeur */
    background-color: #f9f9f9; /* Couleur de fond */
}

/* Style pour les labels */
.form-label {
    font-weight: bold; /* Texte en gras */
    color: #333; /* Couleur du texte */
}

/* Style pour les champs de saisie */
.form-control {
    border-radius: 5px; /* Coins arrondis */
    border: 1px solid #ccc; /* Bordure grise */
    padding: 10px; /* Espacement intérieur */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Ombre interne */
}

/* Style pour le bouton */
.btn-primary {
    background-color: #62A1D9; /* Couleur de fond */
    border: none; /* Supprimer la bordure */
    color: white; /* Couleur du texte */
    padding: 10px 20px; /* Espacement intérieur */
    border-radius: 5px; /* Coins arrondis */
    cursor: pointer; /* Curseur en main */
    transition: background-color 0.3s ease; /* Transition pour le changement de couleur */
}

.btn-primary:hover {
    background-color: #4A8EB7; /* Couleur de fond au survol */
}

/* Style pour le champ de sélection */
.select-categorie {
    border-radius: 5px; /* Coins arrondis */
    border: 1px solid #ccc; /* Bordure grise */
    padding: 10px; /* Espacement intérieur */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Ombre interne */
    width: 100%; /* Largeur à 100% */
}

/* Style pour les éléments de formulaire dans des containers */
.mb-3 {
    margin-bottom: 1rem; /* Marge inférieure */
}

</style>
<br><br>
<form action="{{ route('persistproduit') }}" method="post">
    @csrf
   <center> <h1 style="color: #4A8EB7">Ajouter un produit</h1></center>
    <div class="mb-3">
      <label for="libelle" class="form-label">Nom Produit</label>
      <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Nom du produit..." required>
    </div>

    <div class="mb-3">
      <label for="categorie" class="form-label">Catégorie</label>
      <select name="categorie" class="form-control select-categorie">
        <option>Choisir une catégorie ...</option>
        @foreach($listcategorie as $c)
            <option value="{{ $c->id }}">{{ $c->nomCategorie }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="number" min="0" class="form-control" name="stock" placeholder="Quantité en stock..." required>
    </div>

    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

    <button type="submit" class="btn btn-primary" name="ajouter" value="Ajouter">Ajouter</button>
</form>
@endsection
