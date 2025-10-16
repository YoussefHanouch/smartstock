@extends('layouts.app')

@section('prod')
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#3B82F6',    // Bleu
                    secondary: '#6B7280',  // Gris
                    success: '#10B981',    // Vert
                    warning: '#F59E0B',    // Orange
                    danger: '#EF4444',     // Rouge
                }
            }
        }
    }
</script>

<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
    }
</style>

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Gestion des Produits
                    </h1>
                    <p class="text-gray-600 mt-2">
                        Gérez votre inventaire de produits efficacement
                    </p>
                </div>
                <a href="{{ route('pdfListeProduit') }}" 
                   class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center space-x-2 transition-colors duration-200">
                    <i class='bx bx-download'></i>
                    <span>Exporter PDF</span>
                </a>
                <!-- Ajouter le bouton CSV -->
                <a href="{{ route('exportProduitsCSV') }}" 
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold flex items-center space-x-2 transition-colors duration-200">
                    <i class='bx bx-download'></i>
                    <span>Exporter CSV</span>
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-success text-white p-4 rounded-lg flex items-center space-x-3">
            <i class='bx bx-check-circle text-xl'></i>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Products -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Produits</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $produitCount }}</h3>
                    </div>
                    <div class="bg-blue-100 rounded-lg p-3">
                        <i class='bx bx-package text-xl text-primary'></i>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Catégories</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $listproduit->unique('categorie')->count() }}</h3>
                    </div>
                    <div class="bg-purple-100 rounded-lg p-3">
                        <i class='bx bx-category text-xl text-purple-600'></i>
                    </div>
                </div>
            </div>

            <!-- Total Stock -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Stock Total</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $listproduit->sum('stock') }}</h3>
                    </div>
                    <div class="bg-green-100 rounded-lg p-3">
                        <i class='bx bx-trending-up text-xl text-success'></i>
                    </div>
                </div>
            </div>

            <!-- Agents -->
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Agents</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $listproduit->unique('nameUser')->count() }}</h3>
                    </div>
                    <div class="bg-orange-100 rounded-lg p-3">
                        <i class='bx bx-user text-xl text-warning'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <!-- Carte de recherche et actions -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Barre de recherche -->
            <div class="flex-1 relative max-w-md">
                <div class="relative">
                    <i class='bx bx-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xl'></i>
                    <input 
                        type="text" 
                        placeholder="Rechercher un produit..." 
                        class="w-full border border-gray-300 rounded-xl pl-12 pr-4 py-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 hover:border-gray-400"
                    >
                    <!-- Indicateur de recherche active -->
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-sliders-h text-gray-400 hover:text-primary cursor-pointer transition-colors"></i>
                    </div>
                </div>
            </div>

            <!-- Bouton d'action -->
            <div class="flex items-center space-x-3">
                <!-- Bouton d'export optionnel -->
              
                @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                <!-- Bouton principal -->
                <a href="{{ route('addproduit') }}" 
                   class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-primary to-secondary text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover-lift hover:scale-105 transform">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nouveau produit
                </a>
                   @endif
@endauth
            </div>
        </div>

        <!-- Filtres rapides (optionnel) -->
        <div class="mt-4 flex flex-wrap gap-2">
           
                    @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                <button class="inline-flex items-center px-3 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors">
                <i class="fas fa-filter mr-1"></i>
                Tous les produits
            </button>
                   @endif
@endauth
        </div>
    </div>
</div>

    <!-- Products Table -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-12">
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center space-x-2">
                        <i class='bx bx-package'></i>
                        <span>Liste des Produits</span>
                    </h3>
                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                        {{ $listproduit->count() }} produits
                    </span>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Agent</th>
                                      @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
               
            
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                      
           @endif
@endauth                 
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($listproduit as $p)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">
                                    #{{ $p->id }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-100 w-10 h-10 rounded-lg flex items-center justify-center">
                                        <span class="text-primary font-semibold">
                                            {{ strtoupper(substr($p->libelle, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $p->libelle }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ $p->categorie }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-1">
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>{{ $p->stock }} unités</span>
                                            <span class="font-medium">
                                                @if($p->stock > 50)
                                                <span class="text-success">Élevé</span>
                                                @elseif($p->stock > 10)
                                                <span class="text-warning">Moyen</span>
                                                @else
                                                <span class="text-danger">Faible</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            @php
                                                $width = min(100, ($p->stock / 100) * 100);
                                                $color = $p->stock > 50 ? 'bg-success' : ($p->stock > 10 ? 'bg-warning' : 'bg-danger');
                                            @endphp
                                            <div class="h-2 rounded-full {{ $color }} transition-all duration-300" style="width: {{ $width }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-orange-100 w-8 h-8 rounded-lg flex items-center justify-center">
                                        <span class="text-warning font-semibold text-sm">
                                            {{ strtoupper(substr($p->nameUser, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-900">{{ $p->nameUser }}</span>
                                </div>
                            </td>
          @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
               
 
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('editproduit',['id'=> $p->id]) }}" 
                                       class="bg-blue-100 hover:bg-primary text-primary hover:text-white p-2 rounded-lg transition-colors duration-200"
                                       title="Modifier">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    <a href="{{ route('deleteproduit',['id'=> $p->id]) }}" 
                                       class="bg-red-100 hover:bg-danger text-danger hover:text-white p-2 rounded-lg transition-colors duration-200"
                                       title="Supprimer"
                                       onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?')">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                            </td>

                                   @endif
@endauth
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">{{ $listproduit->count() }}</span> produits
                    </p>
                    <div class="flex items-center space-x-2">
                        {{ $listproduit->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[type="text"]');
        const tableRows = document.querySelectorAll('tbody tr');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection