@extends('layouts.app')

@section('categ')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

   <title>Liste des Catégories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#62A1D9',
                        secondary: '#3A7BD5',
                        success: '#10B981',
                        danger: '#EF4444',
                        warning: '#F59E0B',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Animations personnalisées */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="max-w-7xl mx-auto">
        <!-- En-tête de page -->
        <div class="mb-8 fade-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Gestion des Catégories</h1>
                    <p class="text-gray-600 mt-2">Gérez et organisez vos catégories de produits</p>
                </div>
                          @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
               
     
                <a href="{{ route('addcategorie') }}" class="mt-4 md:mt-0 inline-flex items-center px-5 py-3 bg-gradient-to-r from-primary to-secondary text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover-lift">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nouvelle Catégorie
                </a>
                              @endif
@endauth
            </div>
        </div>

        <!-- Alertes -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg fade-in">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg fade-in">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Carte principale -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden fade-in">
            <!-- En-tête de carte -->
            <div class="bg-gradient-to-r from-primary to-secondary px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-list-alt text-white text-2xl mr-3"></i>
                        <h2 class="text-xl font-semibold text-white">Liste des Catégories</h2>
                    </div>
                    <div class="text-black bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm">
                        {{ count($listCategorie) }} catégorie(s)
                    </div>
                </div>
            </div>

            <!-- Contenu de la carte -->
            <div class="p-6">
                @if(count($listCategorie) > 0)
                <div class="overflow-x-auto rounded-xl border border-gray-200">
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
                                    <div class="flex items-center">
                                        <span>Nom de la Catégorie</span>
                                        <i class="fas fa-sort ml-1 text-gray-400"></i>
                                    </div>
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
                            @foreach($listCategorie as $c)
                            
                            <tr class="hover:bg-blue-50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $c->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-primary mr-3"></div>
                                        <div class="text-sm font-medium text-gray-900">{{ $c->nomCategorie }}</div>
                                    </div>
                                </td>
          @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
          
        
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('editcategorie', ['id' => $c->id]) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-warning hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200 shadow-sm hover-lift">
                                            <i class="fas fa-edit mr-1"></i>
                                            Modifier
                                        </a>
                                        <a href="{{ route('deletecategorie', ['id'=> $c->id ]) }}" 
                                           onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?')"
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-danger hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 shadow-sm hover-lift">
                                            <i class="fas fa-trash mr-1"></i>
                                            Supprimer
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
                @else
                <!-- État vide -->
                <div class="text-center py-12">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-blue-100">
                        <i class="fas fa-inbox text-primary text-3xl"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune catégorie trouvée</h3>
                    <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto">
                        Commencez par créer votre première catégorie pour organiser vos produits.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('addcategorie') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-primary to-secondary text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover-lift">
                            <i class="fas fa-plus-circle mr-2"></i>
                            Créer une catégorie
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Pied de carte -->
            @if(count($listCategorie) > 0)
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">{{ count($listCategorie) }}</span> sur <span class="font-medium">{{ count($listCategorie) }}</span> catégories
                    </div>
                    <!-- Pagination (si nécessaire) -->
                    <div class="mt-4 md:mt-0">
                        <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-left mr-1"></i>
                                Précédent
                            </a>
                            <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                1
                            </a>
                            <a href="#" class="inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                Suivant
                                <i class="fas fa-chevron-right ml-1"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Statistiques (optionnel) -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 fade-in">
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-primary mr-4">
                        <i class="fas fa-layer-group text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Catégories</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($listCategorie) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Catégories Actives</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($listCategorie) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-amber-100 text-amber-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                   <div>
            <p class="text-sm font-medium text-gray-600">Dernière mise à jour</p>
            <p class="text-lg font-bold text-gray-900">
                {{ $latestCategorie->created_at->diffForHumans() }}
            </p>
</div>

                </div>
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
            
            // Confirmation de suppression améliorée
            document.querySelectorAll('a[onclick*="confirm"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!confirm('Voulez-vous vraiment supprimer cette catégorie ? Cette action est irréversible.')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection
