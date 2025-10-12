@extends('layouts.app')

@section('sortie')
<script src="https://cdn.tailwindcss.com"></script>
<!-- Dans la section <head> de votre layout -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Tailwind CSS (si utilisé) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap (si utilisé) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#3B82F6',
                    secondary: '#1E40AF',
                    success: '#10B981',
                    warning: '#F59E0B',
                    danger: '#EF4444',
                    dark: '#1F2937',
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
    
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- En-tête de page -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">📋 Gestion des Sorties</h1>
            <p class="text-xl text-gray-600">Suivez toutes les factures et sorties de produits</p>
        </div>

        <!-- Message de succès -->
        @if(!empty($sms))
        <div class="bg-green-500 text-white p-4 rounded-2xl shadow-lg mb-6 flex items-center space-x-3 animate-pulse">
            <i class='bx bx-check-circle text-2xl'></i>
            <span class="text-lg font-semibold">{{ $sms }}</span>
        </div>
        @endif

        <!-- Cartes de statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Factures</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $listeSortiecount }}</h3>
                    </div>
                    <div class="bg-blue-100 rounded-xl p-3">
                        <i class='bx bx-receipt text-2xl text-primary'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Produits Vendus</p>
                        <h3 class="text-2xl font-bold text--900">{{ $listsum}}</h3>
                    </div>
                    <div class="bg-green-100 rounded-xl p-3">
                        <i class='bx bx-package text-2xl text-success'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Chiffre d'Affaires</p>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ number_format($listeSortie->sum('prix'), 2, ',', ' ') }} DH
                        </h3>
                    </div>
                    <div class="bg-purple-100 rounded-xl p-3">
                        <i class='bx bx-money text-2xl text-purple-600'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Clients</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $listeSortie->unique('nom_client')->count() }}</h3>
                    </div>
                    <div class="bg-orange-100 rounded-xl p-3">
                        <i class='bx bx-user text-2xl text-warning'></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carte principale -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- En-tête de la carte -->
            <div class="bg-gradient-to-r from-primary to-secondary px-6 py-4">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <h2 class="text-xl font-bold text-white flex items-center space-x-3">
                        <i class='bx bx-list-ul'></i>
                        <span>Liste des Factures</span>
                    </h2>
                    <a href="/sortie/add" 
                       class="bg-white text-primary hover:bg-gray-100 px-6 py-2 rounded-xl font-semibold transition-colors duration-200 flex items-center space-x-2">
                        <i class='bx bx-plus'></i>
                        <span>Nouvelle Facture</span>
                    </a>
                </div>
            </div>

            <!-- Tableau -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantité</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Agent</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($listeSortie as $ls)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                          
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-primary text-white w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold">
                                        {{ strtoupper(substr($ls->nomProduit, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $ls->nomProduit }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $ls->quantite }} unités
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900">
                                    {{ number_format($ls->prix, 2, ',', ' ') }} DH
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-600">{{ \Carbon\Carbon::parse($ls->dateSortie)->format('d/m/Y') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <div class="bg-orange-100 text-warning w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">
                                        {{ strtoupper(substr($ls->nameUser, 0, 1)) }}
                                    </div>
                                    <span class="text-gray-700">{{ $ls->nameUser }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $ls->nom_client }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
    <div class="flex space-x-3 opacity-9 group-hover:opacity-100 transition-opacity duration-300">
        <a href="{{ route('editsortie',$ls->id) }}" 
           class="text-gray-400 hover:text-blue-600 p-2 transition-colors duration-200"
           title="Modifier">
            <i class='bx bx-edit-alt text-xl'></i>
        </a>
        
        <form action="{{ route('destroysortie', $ls->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="text-gray-400 hover:text-red-600 p-2 transition-colors duration-200"
                    title="Supprimer"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">
                <i class='bx bx-trash text-xl'></i>
            </button>
        </form>
        
        <a href="{{ route('pdfsortie', $ls->id ) }}" 
           class="text-gray-400 hover:text-green-600 p-2 transition-colors duration-200"
           title="Imprimer PDF">
            <i class='bx bx-printer text-xl'></i>
        </a>
    </div>
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pied de tableau -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <p class="text-gray-600 text-sm">
                    </p>
                    <div class="flex justify-center">
                        {{ $listeSortie->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes statistiques
        const statCards = document.querySelectorAll('.hover-lift');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Confirmation de suppression
        const deleteForms = document.querySelectorAll('form[method="POST"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cette facture ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection