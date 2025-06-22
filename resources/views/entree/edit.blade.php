@extends('layouts.app')

@section('entre')
<style>
/* Style général pour le formulaire */
form {
    max-width: 600px; /* Largeur maximale du formulaire */
    margin: 20px auto; /* Centrer le formulaire horizontalement */
    padding: 20px; /* Ajouter de l'espace à l'intérieur du formulaire */
    border: 1px solid #ddd; /* Bordure grise */
    border-radius: 10px; /* Coins arrondis */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre pour un effet de profondeur */
    background-color: #f9f9f9; /* Couleur de fond */
}

/* Style pour les labels */
.form-group label {
    font-weight: bold; /* Texte en gras */
    color: #333; /* Couleur du texte */
    display: block; /* Afficher en bloc */
    margin-bottom: 5px; /* Marge inférieure */
}

/* Style pour les champs de saisie */
.form-control {
    border-radius: 5px; /* Coins arrondis */
    border: 1px solid #ccc; /* Bordure grise */
    padding: 10px; /* Espacement intérieur */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1); /* Ombre interne */
    width: 100%; /* Largeur à 100% */
}

/* Style pour le bouton */
.btn {
    padding: 10px 20px; /* Espacement intérieur */
    border-radius: 5px; /* Coins arrondis */
    color: white; /* Couleur du texte */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Transition pour le changement de couleur */
}

.btn-success {
    background-color: #28a745; /* Vert */
    border: none; /* Supprimer la bordure */
}

.btn-success:hover {
    background-color: #218838; /* Vert plus foncé */
}

.btn-danger {
    background-color: #dc3545; /* Rouge */
    border: none; /* Supprimer la bordure */
}

.btn-danger:hover {
    background-color: #c82333; /* Rouge plus foncé */
}

/* Style pour les liens */
.btn-block {
    display: block;
    width: 100%;
}

/* Style pour les containers */
.container {
    padding: 20px;
}

.row {
    margin: 0 -15px;
}

.col-md-6 {
    padding: 0 15px;
}

/* Style pour les champs de date */
input[type="date"] {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 10px;
    width: 100%;
}



</style>

@section('content')
<div class="container mt-4">
    <div class="">
        <div class="">
            <div class="">
            

                <div class="card-body">
                  <center> <h3> Modifier une entrée de produit</h3></center>

                    <form action="{{ route ('updateentree') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $entree->id }}">
                        
                        <div class="form-group">
                            <label for="produit">Produit</label>
                            <select name="produit" id="produit" class="form-control">
                                @foreach($listproduit as $p)
                                <option value="{{ $p->id }}" {{ $p->id == $entree->produit_id ? 'selected' : '' }}>{{ $p->libelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" min="0" class="form-control" name="quantite" value="{{ $entree->quantite }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <input type="number" min="0" class="form-control" name="prix" value="{{ $entree->prix }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" name="dateEntree" value="{{ $entree->dateEntree }}" required>
                        </div>
                        
                        <div class="form-group">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" name="modifier" value="Modifier" class="btn btn-success btn-block">
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('listentree') }}" class="btn btn-danger btn-block">Annuler</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
