@extends('layouts.app')

@section('categ')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Éditer une Catégorie</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('updatecategorie', ['id' => $category->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label for="categorie" class="form-label">Nom de la Catégorie</label>
                            <input type="text" class="form-control @error('categorie') is-invalid @enderror" id="categorie" name="categorie" value="{{ $category->nomCategorie }}" required>
                            @error('categorie')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group d-flex ">
                            <button type="submit" class="btn btn-success">Enregistrer</button> &nbsp; &nbsp;
                            <a href="{{ route('listcategorie') }}" class="btn btn-danger">Annuler</a>
                        </div>
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
    .btn-danger {
        background-color: #dc3545;
        border: none;
    }
    .btn-danger:hover {
        background-color: #c82333;
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
