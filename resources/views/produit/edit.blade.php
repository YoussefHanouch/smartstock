@extends('layouts.app')

@section('prod')

@section('content')

<style>
    .card-header {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 15px;
        border-radius: 5px 5px 0 0;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        display: block;
    }

    .form-control {
        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .btn {
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        text-transform: uppercase;
        cursor: pointer;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn {
        text-decoration: none;
        color: white;
        display: inline-block;
        text-align: center;
    }

    .container {
        max-width: 800px;
        margin: auto;
    }

    .row {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .col-md-12 {
        padding: 10px;
    }
</style>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h3">
                    Modifier un produit
                </div>

                <div class="card-body">
                    <form action="{{ route('updateproduit') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $produit->id }}">
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" class="form-control" name="libelle" value="{{ $produit->libelle }}" required>
                        </div>
                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <select name="categorie" class="form-control">
                                @foreach($listcategorie as $c)
                                <option value="{{ $c->id }}" {{ $produit->categorie_id == $c->id ? 'selected' : '' }}>{{ $c->nomCategorie }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" min="0" class="form-control" name="stock" value="{{ $produit->stock }}" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                            <div class="d-flex ">
                                <input type="submit" name="modifier" value="Modifier" class="btn btn-success">  &nbsp;   &nbsp; 
                                <a href="{{ route('listproduit') }}" class="btn btn-danger">Annuler</a>
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
