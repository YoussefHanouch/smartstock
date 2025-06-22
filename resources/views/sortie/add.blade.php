@extends('layouts.app')

@section('sortie')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header  text-white text-center">
                    <h3 style="color:cornflowerblue">Ajouter une Sortie de Produit</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('persistsortieproduit') }}" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="produit" class="form-label">Produit</label>
                            <select name="produit" id="produit" class="form-control @error('produit') is-invalid @enderror">
                                @foreach($listeProduit as $p)
                                <option value="{{ $p->id }}">{{ $p->libelle }}</option>
                                @endforeach
                            </select>
                            @error('produit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="prix" class="form-label">Prix Unitaire</label>
                            <input type="number" name="prix" min="0" class="form-control @error('prix') is-invalid @enderror" required placeholder="Le prix unitaire ...">
                            @error('prix')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" name="quantite" min="0" class="form-control @error('quantite') is-invalid @enderror" required placeholder="Quantité à sortir...">
                            @error('quantite')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="nom_client" class="form-label">Nom Client</label>
                            <input type="text" name="nom_client" class="form-control @error('nom_client') is-invalid @enderror" required placeholder="Nom du client ...">
                            @error('nom_client')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="dateSortie" class="form-label">Date de Sortie</label>
                            <input type="date" name="dateSortie" class="form-control @error('dateSortie') is-invalid @enderror" required>
                            @error('dateSortie')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <button type="submit" class="btn btn btn-block mt-3" style="background-color:cornflowerblue;color:#ffff">Ajouter</button>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 900px;
        margin-top: 50px;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #007bff;
        color: #fff;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 20px;
    }
    .card-body {
        padding: 20px;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 10px;
    }
    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 1rem;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }
    .btn {
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
    }
    .btn-success:hover {
        background-color: #218838;
    }
    .btn-block {
        display: block;
        width: 100%;
        text-align: center;
        padding: 10px;
        margin: 10px 0;
    }
    .invalid-feedback {
        display: block;
        color: #dc3545;
        margin-top: 5px;
    }
    .card-footer {
        padding: 10px 20px;
        background-color: #f8f9fa;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        text-align: center;
    }
</style>
