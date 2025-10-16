@extends('layouts.app')

@section('user')
@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1D4ED8',
                        accent: '#10B981',
                        danger: '#EF4444',
                        warning: '#F59E0B'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
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
<body class="min-h-screen" x-data="{ openModal: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- En-tête de page -->
        <div class="mb-8 fade-in">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Gestion des Administrateurs</h1>
                    <p class="text-gray-600 mt-2">Gérez les accès et permissions des administrateurs</p>
                </div>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <!-- Statistiques rapides -->
                    <div class="bg-white rounded-xl p-4 shadow-sm border">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-users text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Admins</p>
                                <p class="font-semibold text-gray-800">{{ count($listUser) }}</p>
                            </div>
                        </div>
                    </div>
                    <button @click="openModal = true" 
                            class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-xl font-medium hover-lift shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                        <i class="fas fa-user-plus mr-2"></i>
                        Nouvel Admin
                    </button>
                </div>
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
                        <i class="fas fa-user-shield text-white text-2xl mr-3"></i>
                        <h2 class="text-xl font-semibold text-white">Liste des Administrateurs</h2>
                    </div>
                    <div class="text-black bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm">
                        {{ count($listUser) }} administrateur(s)
                    </div>
                </div>
            </div>

            <!-- Contenu de la carte -->
            <div class="p-6">
                @if(count($listUser) > 0)
                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom & Prénom
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rôle
                                </th>
                                @if(auth()->user()->role === 'super_admin')
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($listUser as $lu)
                            <tr class="hover:bg-blue-50 transition-colors duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">#{{ $lu->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                            {{ substr($lu->name, 0, 1) }}
                                        </div>
                                        <div class="text-sm font-medium text-gray-900">{{ $lu->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $lu->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($lu->role === 'super_admin')
                                    <span class="status-badge bg-purple-100 text-purple-800">
                                        <i class="fas fa-crown mr-1"></i>Super Admin
                                    </span>
                                    @else
                                    <span class="status-badge bg-blue-100 text-blue-800">
                                        <i class="fas fa-user-gear mr-1"></i>Admin
                                    </span>
                                    @endif
                                </td>
                                @if(auth()->user()->role === 'super_admin')
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('editutilisateur', $lu->id) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-warning hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200 shadow-sm hover-lift">
                                            <i class="fas fa-edit mr-1"></i>
                                            Modifier
                                        </a>
                                 <form action="{{ route('deleteutilisateur', $lu->id) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    class="delete-btn inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 shadow-sm hover-lift">
                                                <i class="fas fa-trash mr-1"></i>
                                                Supprimer
                                            </button>
                                    </form>

                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <!-- État vide -->
                <div class="text-center py-12">
                    <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-blue-100">
                        <i class="fas fa-users text-primary text-3xl"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun administrateur trouvé</h3>
                    <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto">
                        Commencez par ajouter votre premier administrateur.
                    </p>
                    <div class="mt-6">
                        <button @click="openModal = true" 
                                class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-primary to-secondary text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover-lift">
                            <i class="fas fa-user-plus mr-2"></i>
                            Ajouter un admin
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal d'ajout -->
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
                            <i class="fas fa-user-plus mr-2"></i>
                            Nouvel Administrateur
                        </h3>
                        <button @click="openModal = false" class="text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('persistutilisateur') }}">
                    @csrf
                    <div class="bg-white px-6 py-4">
                        <div class="space-y-4">
                            <!-- Nom complet -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-2 text-primary"></i>Nom & Prénom
                                </label>
                                <input id="name" 
                                       type="text" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                        
                                       autocomplete="name" 
                                       autofocus
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                                       placeholder="Entrez le nom complet">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-primary"></i>Adresse email
                                </label>
                                <input id="email" 
                                       type="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                        
                                       autocomplete="email"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                                       placeholder="email@exemple.com">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Rôle -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user-tag mr-2 text-primary"></i>Rôle
                                </label>
                                <select id="role" 
                                        name="role"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200">
                                    <option value="admin">Administrateur</option>
                                    <option value="super_admin">Super Administrateur</option>
                                </select>
                                @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Mot de passe -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-primary"></i>Mot de passe
                                </label>
                                <input id="password" 
                                       type="password" 
                                       name="password" 
                                        
                                       autocomplete="new-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                                       placeholder="••••••••">
                                @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Confirmation mot de passe -->
                            <div>
                                <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-primary"></i>Confirmer le mot de passe
                                </label>
                                <input id="password-confirm" 
                                       type="password" 
                                       name="password_confirmation" 
                                        
                                       autocomplete="new-password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200"
                                       placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                        <button type="button" 
                                @click="openModal = false" 
                                class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-accent to-green-600 text-white rounded-xl font-medium hover-lift shadow-sm hover:shadow-md transition-all duration-200">
                            <i class="fas fa-user-plus mr-2"></i>
                            Créer le compte
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
            
            // Gestion des confirmations de suppression
            document.querySelectorAll('form[action*="deleteutilisateur"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ? Cette action est irréversible.')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        });
    @elseif ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Erreur de validation',
            html: `
                <ul style="text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#d33',
        });
    @endif
</script>

@endsection


