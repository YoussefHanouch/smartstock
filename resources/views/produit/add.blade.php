@extends('layouts.app')

@section('prod')
@section('content')

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1D4ED8'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen ">
    <div class="max-w-md mx-auto px-4">
        <!-- Carte compacte -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <!-- En-tête -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-600 rounded-lg mb-3">
                    <i class="fas fa-cube text-white"></i>
                </div>
                <h1 class="text-xl font-bold text-gray-800">Nouveau produit</h1>
                <p class="text-gray-600 text-sm mt-1">Ajoutez un produit à votre inventaire</p>
            </div>

            <form action="{{ route('persistproduit') }}" method="post">
                @csrf
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

                <!-- Nom du produit -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag mr-2 text-blue-600"></i>Nom du produit
                    </label>
                    <input type="text" 
                           name="libelle" 
                           required
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           placeholder="Ex: Ordinateur Portable Dell">
                </div>

                <!-- Catégorie -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-layer-group mr-2 text-blue-600"></i>Catégorie
                    </label>
                    <select name="categorie" 
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="" disabled selected>Sélectionnez une catégorie</option>
                        @foreach($listcategorie as $c)
                            <option value="{{ $c->id }}">{{ $c->nomCategorie }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Stock -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-boxes mr-2 text-blue-600"></i>Stock initial
                    </label>
                    <input type="number" 
                           name="stock" 
                           min="0" 
                           required
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                           placeholder="0">
                    <p class="text-xs text-gray-500 mt-1">Quantité disponible en stock</p>
                </div>

                <!-- Bouton -->
                <button type="submit" 
                        name="ajouter" 
                        value="Ajouter"
                        class="w-full py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors shadow hover:shadow-md flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter le produit
                </button>
            </form>

            <!-- Lien de retour -->
            <div class="text-center mt-4">
                <a href="{{ route('listproduit') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Retour aux produits
                </a>
            </div>
        </div>
    </div>

@endsection
