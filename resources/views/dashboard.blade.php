@extends('layouts.app')

@section('dash')

<style>
    /* Active state for nav-link */
.side-menu .nav-item.active .nav-link {
    color: #3b82f6;
}

</style>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{asset('image/2.jpg')}}" class="card-img-top" alt="Image de Produits">
                <div class="card-body">
                    <h5 class="card-title">carte des Produits</h5>
                    <a href="{{route('addproduit')}}" class="btn btn-primary">Ajoute</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{asset('image/1.jpg')}}" class="card-img-top" alt="Image de Catégories">
                <div class="card-body">
                    <h5 class="card-title">carte des Catégories</h5>
                    <a href="{{route('addcategorie')}}" class="btn btn-primary">Ajoute</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{asset('image/3.jpg')}}" class="card-img-top" alt="Image de Utilisateurs">
                <div class="card-body">
                    <h5 class="card-title">carte de Factures</h5>
                    <a href="{{route('addsortie')}}" class="btn btn-primary">Ajoute</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
