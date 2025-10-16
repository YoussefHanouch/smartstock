@extends('layouts.app')

@section('content')

<title>Dashboard Visiteur - StockFlow</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="min-h-screen bg-gray-100">
<div class="max-w-7xl mx-auto px-4 py-8">

    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tableau de Bord Visiteur</h1>
        <p class="text-gray-600 mt-2">Vous pouvez consulter les stocks mais pas modifier les données.</p>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-lg border">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-100 p-3 rounded-xl">
                    <i class="fas fa-boxes text-2xl text-blue-600"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">{{ $productCount }}</span>
            </div>
            <h3 class="text-lg font-semibold mb-2">Produits</h3>
            <p class="text-gray-600 text-sm">En stock actuellement</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-100 p-3 rounded-xl">
                    <i class="fas fa-layer-group text-green-600 text-2xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">{{ $categoryCount }}</span>
            </div>
            <h3 class="text-lg font-semibold mb-2">Catégories</h3>
            <p class="text-gray-600 text-sm">Actives</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-100 p-3 rounded-xl">
                    <i class="fas fa-sign-in-alt text-blue-600 text-2xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">{{ $entryCount }}</span>
            </div>
            <h3 class="text-lg font-semibold mb-2">Entrées</h3>
            <p class="text-gray-600 text-sm">Total des entrées</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg border">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-purple-100 p-3 rounded-xl">
                    <i class="fas fa-receipt text-purple-600 text-2xl"></i>
                </div>
                <span class="text-2xl font-bold text-gray-800">{{ $exitCount }}</span>
            </div>
            <h3 class="text-lg font-semibold mb-2">Factures / Sorties</h3>
            <p class="text-gray-600 text-sm">Total générées</p>
        </div>
    </div>

    <!-- Liens vers listes consultables -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <a href="{{ route('visitor.products') }}" class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl flex flex-col items-center justify-center">
            <i class="fas fa-boxes text-3xl text-blue-600 mb-2"></i>
            <span class="font-medium text-gray-800">Produits</span>
        </a>
        <a href="{{ route('visitor.categories') }}" class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl flex flex-col items-center justify-center">
            <i class="fas fa-layer-group text-3xl text-green-600 mb-2"></i>
            <span class="font-medium text-gray-800">Catégories</span>
        </a>
        <a href="{{ route('visitor.entries') }}" class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl flex flex-col items-center justify-center">
            <i class="fas fa-sign-in-alt text-3xl text-blue-600 mb-2"></i>
            <span class="font-medium text-gray-800">Entrées Stock</span>
        </a>
        <a href="{{ route('visitor.exits') }}" class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl flex flex-col items-center justify-center">
            <i class="fas fa-receipt text-3xl text-purple-600 mb-2"></i>
            <span class="font-medium text-gray-800">Factures / Sorties</span>
        </a>
    </div>

</div>

@endsection
