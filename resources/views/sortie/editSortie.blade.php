@extends('layouts.app')

@section('sortie', 'active')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h2>Modifier une sortie de produit</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('sortieupdate', $sortie->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="produit">Produit</label>
                            <select name="produit" id="" class="form-control">
                                @foreach($listeProduit as $p)
                                <option value="{{ $p->id }}" {{ $p->id == $sortie->produit_id ? 'selected' : '' }}>{{ $p->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="prix">Prix unitaire</label>
                            <input type="number" name="prix" min="100" class="form-control" value="{{ $sortie->prix }}" required placeholder="Le prix unitaire ...">
                        </div>

                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" name="quantite" min="0" class="form-control" value="{{ $sortie->quantite }}" required placeholder="Quantité à sortir...">
                        </div>

                        <div class="form-group">
                            <label for="dateSortie">Date de sortie</label>
                            <input type="date" name="dateSortie" class="form-control" value="{{ $sortie->dateSortie }}" required>
                        </div>

                        <div class="form-group">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="reset"  onclick="window.history.back();" value="Annuler" class="btn btn-danger btn-block">
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" name="enregistrer" value="Enregistrer" class="btn btn-success btn-block">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
