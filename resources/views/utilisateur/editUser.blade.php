@extends('layouts.app')

@section('content')

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3B82F6',
                            600: '#2563eb',
                            700: '#1d4ed8'
                        },
                        secondary: '#1D4ED8',
                        accent: '#10B981',
                        dark: '#1F2937'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        
        .btn-primary {
            background: linear-gradient(to right, #10B981, #059669);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary {
            background: linear-gradient(to right, #6B7280, #4B5563);
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: linear-gradient(to right, #4B5563, #374151);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .badge-admin {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .badge-super-admin {
            background-color: #f3e8ff;
            color: #7e22ce;
        }
    </style>
</head>
<body class="font-inter">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-2xl mx-auto fade-in">
            <!-- En-tête de la page -->
            <div class="text-center mb-8" >
                <h1 class="text-3xl font-bold text-black mb-2">Gestion des Administrateurs</h1>
                <p class="text-black/80">Modifier les informations d'un administrateur du système</p>
            </div>

            <!-- Carte principale -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover mb-6">
                <!-- En-tête de la carte -->
                <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-lg mr-3">
                                <i class="fas fa-user-edit text-white text-xl"></i>
                            </div>
                            <h2 class="text-xl font-semibold text-white">Modifier l'Administrateur</h2>
                        </div>
                        <div class="bg-white/20 px-3 py-1 rounded-full">
                            <span class="text-white text-sm font-medium">ID: #{{ $user->id }}</span>
                        </div>
                    </div>
                </div>

                <!-- Corps du formulaire -->
                <div class="p-6">
                    <form method="POST" action="{{ route('updateutilisateur', $user->id) }}" id="adminForm">
                        @csrf
                        @method('PUT')

                        <!-- Nom complet -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <div class="bg-primary-100 p-1.5 rounded-lg mr-2">
                                    <i class="fas fa-user text-primary-600 text-sm"></i>
                                </div>
                                <span>Nom & Prénom</span>
                            </label>
                            <input id="name" 
                                   type="text" 
                                   name="name" 
                                   value="{{ $user->name }}" 
                                   required 
                                   autocomplete="name" 
                                   autofocus
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus focus:outline-none focus:border-primary-500 transition-all duration-200 @error('name') border-red-500 @enderror"
                                   placeholder="Entrez le nom complet">
                            @error('name')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <div class="bg-primary-100 p-1.5 rounded-lg mr-2">
                                    <i class="fas fa-envelope text-primary-600 text-sm"></i>
                                </div>
                                <span>Adresse email</span>
                            </label>
                            <input id="email" 
                                   type="email" 
                                   name="email" 
                                   value="{{ $user->email }}" 
                                   required 
                                   autocomplete="email"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus focus:outline-none focus:border-primary-500 transition-all duration-200 @error('email') border-red-500 @enderror"
                                   placeholder="email@exemple.com">
                            @error('email')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        @if(auth()->user()->role === 'super_admin')
                            <!-- Rôle -->
                            <div class="mb-6">
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <div class="bg-primary-100 p-1.5 rounded-lg mr-2">
                                        <i class="fas fa-user-tag text-primary-600 text-sm"></i>
                                    </div>
                                    <span>Rôle</span>
                                </label>
                                <select id="role" 
                                        name="role"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus focus:outline-none focus:border-primary-500 transition-all duration-200 @error('role') border-red-500 @enderror">
                                    <option value="admin" @if($user->role === 'admin') selected @endif>Administrateur</option>
                                    <option value="super_admin" @if($user->role === 'super_admin') selected @endif>Super Administrateur</option>
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-6">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <div class="bg-primary-100 p-1.5 rounded-lg mr-2">
                                        <i class="fas fa-lock text-primary-600 text-sm"></i>
                                    </div>
                                    <span>Nouveau mot de passe</span>
                                </label>
                                <div class="relative">
                                    <input id="password" 
                                           type="password" 
                                           name="password" 
                                           autocomplete="new-password"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus focus:outline-none focus:border-primary-500 transition-all duration-200 @error('password') border-red-500 @enderror"
                                           placeholder="Laissez vide pour ne pas modifier">
                                    <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <p class="text-gray-500 text-xs mt-2 flex items-center">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Optionnel - Laissez vide pour conserver le mot de passe actuel
                                </p>
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div class="mb-6">
                                <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <div class="bg-primary-100 p-1.5 rounded-lg mr-2">
                                        <i class="fas fa-lock text-primary-600 text-sm"></i>
                                    </div>
                                    <span>Confirmer le mot de passe</span>
                                </label>
                                <div class="relative">
                                    <input id="password-confirm" 
                                           type="password" 
                                           name="password_confirmation" 
                                           autocomplete="new-password"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl input-focus focus:outline-none focus:border-primary-500 transition-all duration-200"
                                           placeholder="Confirmez le nouveau mot de passe">
                                    <button type="button" id="togglePasswordConfirm" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-primary-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div id="password-match" class="text-sm mt-2 hidden">
                                    <i class="fas fa-check mr-1"></i>
                                    <span>Les mots de passe correspondent</span>
                                </div>
                                <div id="password-mismatch" class="text-sm mt-2 hidden">
                                    <i class="fas fa-times mr-1"></i>
                                    <span>Les mots de passe ne correspondent pas</span>
                                </div>
                            </div>
                        @endif

                        <!-- Boutons d'action -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-200">
                            <button type="submit" 
                                    class="flex-1 py-3 btn-primary text-white font-semibold rounded-xl flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i>
                                Enregistrer les modifications
                            </button>
                            <a href="{{ url()->previous() }}" 
                               class="flex-1 py-3 btn-secondary text-white font-semibold rounded-xl text-center flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informations supplémentaires -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6 card-hover">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <div class="bg-primary-100 p-2 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-primary-600"></i>
                    </div>
                    Informations de l'administrateur
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-id-card text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-600">ID Utilisateur</p>
                            <p class="font-semibold text-gray-800">#{{ $user->id }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-user-tag text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-600">Rôle actuel</p>
                            <p class="font-semibold text-gray-800">
                                @if($user->role === 'super_admin')
                                    <span class="badge-super-admin px-3 py-1 rounded-full text-xs font-medium">Super Admin</span>
                                @else
                                    <span class="badge-admin px-3 py-1 rounded-full text-xs font-medium">Admin</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-calendar text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-600">Date de création</p>
                            <p class="font-semibold text-gray-800">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="bg-amber-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-clock text-amber-600"></i>
                        </div>
                        <div>
                            <p class="text-gray-600">Dernière modification</p>
                            <p class="font-semibold text-gray-800">{{ $user->updated_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Note importante -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 card-hover">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-lg mr-3 mt-0.5">
                        <i class="fas fa-exclamation-triangle text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-blue-800 text-sm mb-1">Note importante</h4>
                        <p class="text-blue-700 text-sm">
                            @if(auth()->user()->role === 'super_admin')
                                En tant que Super Administrateur, vous pouvez modifier tous les paramètres de cet utilisateur, y compris son rôle et son mot de passe.
                            @else
                                Vous pouvez modifier vos informations personnelles. La modification du rôle nécessite l'intervention d'un Super Administrateur.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animation au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('adminForm');
            form.style.opacity = '0';
            form.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                form.style.transition = 'all 0.5s ease';
                form.style.opacity = '1';
                form.style.transform = 'translateY(0)';
            }, 100);
            
            // Initialiser les fonctionnalités de mot de passe
            initPasswordFeatures();
        });

        // Fonctionnalités pour les champs de mot de passe
        function initPasswordFeatures() {
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password-confirm');
            const passwordMatch = document.getElementById('password-match');
            const passwordMismatch = document.getElementById('password-mismatch');
            
            // Basculer la visibilité du mot de passe
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
            
            // Basculer la visibilité de la confirmation du mot de passe
            if (togglePasswordConfirm) {
                togglePasswordConfirm.addEventListener('click', function() {
                    const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordConfirm.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
            
            // Validation en temps réel de la correspondance des mots de passe
            if (password && passwordConfirm) {
                passwordConfirm.addEventListener('input', function() {
                    const passwordValue = password.value;
                    const confirmPasswordValue = this.value;
                    
                    if (passwordValue && confirmPasswordValue) {
                        if (passwordValue === confirmPasswordValue) {
                            passwordConfirm.classList.remove('border-red-500');
                            passwordConfirm.classList.add('border-green-500');
                            passwordMatch.classList.remove('hidden');
                            passwordMismatch.classList.add('hidden');
                        } else {
                            passwordConfirm.classList.remove('border-green-500');
                            passwordConfirm.classList.add('border-red-500');
                            passwordMatch.classList.add('hidden');
                            passwordMismatch.classList.remove('hidden');
                        }
                    } else {
                        passwordConfirm.classList.remove('border-red-500', 'border-green-500');
                        passwordMatch.classList.add('hidden');
                        passwordMismatch.classList.add('hidden');
                    }
                });
                
                password.addEventListener('input', function() {
                    if (passwordConfirm.value) {
                        passwordConfirm.dispatchEvent(new Event('input'));
                    }
                });
            }
        }
    </script>
    
    

@endsection
