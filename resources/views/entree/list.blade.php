@extends('layouts.app')

@section('entre')
@section('content')
<title>Liste des Entrées</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#62A1D9',
                        secondary: '#4A8EB7',
                        success: '#10B981',
                        warning: '#F59E0B',
                        danger: '#EF4444',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>
</head>
<body  x-data="{ openModal: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête de page -->
        <div class="mb-8 fade-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Gestion des Entrées</h1>
                    <p class="text-gray-600 mt-2">Suivez les entrées de produits dans votre inventaire</p>
                </div>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <!-- Statistiques rapides -->
                    <div class="bg-white rounded-xl p-3 shadow-sm">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-boxes text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Entrées</p>
                                <p class="font-semibold text-gray-800">{{ count($listentree) }}</p>
                            </div>
                        </div>
                    </div>          @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
               <button @click="openModal = true" 
                            class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-xl font-medium hover-lift shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Nouvelle Entrée
                    </button>
                   @endif
@endauth
                    
                </div>
            </div>
        </div>

        <!-- Carte principale -->
        <div class="glass-card rounded-2xl shadow-xl overflow-hidden fade-in">
            <!-- En-tête de carte -->
            <div class="bg-gradient-to-r from-primary to-secondary px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-sign-in-alt text-white text-2xl mr-3"></i>
                        <h2 class="text-xl font-semibold text-white">Liste des Entrées de Produits</h2>
                    </div>
                    <div class="text-black bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm">
                        {{ count($listentree) }} entrée(s)
                    </div>
                </div>
            </div>

            <!-- Contenu de la carte -->
            <div class="p-6">
                @if(count($listentree) > 0)
                <div class="overflow-x-auto rounded-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>ID</span>
                                        <i class="fas fa-sort ml-1 text-gray-400"></i>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Produit
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantité
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Prix Unitaire
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Agent
                                </th>
     @auth
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                                
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Actions
                                     </th>
                                                                @endif
                    @endauth
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($listentree as $e)
                            <tr class="hover:bg-blue-50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $e->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-primary mr-3"></div>
                                        <div class="text-sm font-medium text-gray-900">{{ $e->nomProduit }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">{{ $e->quantite }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-green-600">{{ $e->prix }} FCFA</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $e->dateEntree }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-primary rounded-full flex items-center justify-center text-white text-xs font-semibold mr-2">
                                            {{ substr($e->nameUser, 0, 1) }}
                                        </div>
                                        <div class="text-sm text-gray-900">{{ $e->nameUser }}</div>
                                    </div>
                                </td>
                                          @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
               
    
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('editentree', ['id'=> $e->id ]) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-warning hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200 shadow-sm hover-lift">
                                            <i class="fas fa-edit mr-1"></i>
                                            Modifier
                                        </a>
                                        <form action="{{ route('destroyEntree', $e->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?')"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-danger hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 shadow-sm hover-lift">
                                                <i class="fas fa-trash mr-1"></i>
                                                Supprimer
                                            </button>
                                        </form>
                                                       @endif
@endauth
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <!-- État vide -->
                <div class="text-center py-12">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-blue-100">
                        <i class="fas fa-inbox text-primary text-3xl"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune entrée trouvée</h3>
                    <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto">
                        Commencez par enregistrer votre première entrée de produits.
                    </p>
                    <div class="mt-6">
                        <button @click="openModal = true" 
                                class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-primary to-secondary text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover-lift">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Ajouter une entrée
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Pagination -->
            @if(count($listentree) > 0)
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">{{ count($listentree) }}</span> entrées
                    </div>
                    <div class="mt-4 md:mt-0">
                        {{ $listentree->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div x-show="openModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto" 
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-gradient-to-r from-primary to-secondary px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white" id="modal-title">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Nouvelle Entrée
                        </h3>
                        <button @click="openModal = false" class="text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <form action="{{ route('persistentree') }}" method="post">
                    @csrf
                    <div class="bg-white px-6 py-4">
                        <div class="space-y-4">
                            <!-- Produit -->
                            <div>
                                <label for="produit" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-cube mr-2 text-primary"></i>Produit
                                </label>
                                <select name="produit" id="produit" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    @foreach($listproduit as $p)
                                        <option value="{{ $p->id }}">{{ $p->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Prix et Quantité -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-money-bill-wave mr-2 text-primary"></i>Prix unitaire
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="prix" min="100" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" required placeholder="Prix unitaire">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 text-sm">FCFA</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="quantite" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-boxes mr-2 text-primary"></i>Quantité
                                    </label>
                                    <input type="number" name="quantite" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" required placeholder="Quantité">
                                </div>
                            </div>
                            
                            <!-- Date -->
                            <div>
                                <label for="dateEntree" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar-alt mr-2 text-primary"></i>Date d'entrée
                                </label>
                                <input type="date" name="dateEntree" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" required>
                            </div>
                            
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                        <button type="button" 
                                @click="openModal = false" 
                                class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" 
                                name="enregistrer" 
                                class="px-6 py-3 bg-gradient-to-r from-success to-green-600 text-white rounded-xl font-medium hover-lift shadow-sm hover:shadow-md transition-all duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Animation d'entrée pour les lignes du tableau
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endsection

