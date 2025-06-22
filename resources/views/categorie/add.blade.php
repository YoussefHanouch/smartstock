@extends('layouts.app')

@section('categ')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header h3" style="color: #007bff">
                    Ajouter une Catégorie
                </div>

                <div class="card-body">
                    <form action="{{ route('persistcategorie') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nomCategorie" class="form-label">Nom de la Catégorie</label>
                            <input type="text" class="form-control @error('categorie') is-invalid @enderror" id="categorie" name="categorie" placeholder="Nom de la catégorie..." required>
                            @error('categorie')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 800px;
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
        text-align: center;
        padding: 20px 0;
    }
    .card-body {
        padding: 20px;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
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
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .invalid-feedback {
        display: block;
        color: #dc3545;
        margin-top: 5px;
    }
</style>
