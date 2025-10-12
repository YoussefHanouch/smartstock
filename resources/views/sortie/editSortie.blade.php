@extends('layouts.app')

@section('sortie', 'active')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une sortie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#EF4444',
                        secondary: '#DC2626',
                        accent: '#10B981',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            min-height: 100vh;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .shadow-soft {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }
        
        .gradient-border {
            position: relative;
            background: linear-gradient(135deg, #FEE2E2, #FECACA);
            padding: 2px;
            border-radius: 16px;
        }
        
        .gradient-border > div {
            background: white;
            border-radius: 14px;
        }
        
        .floating-label {
            transition: all 0.3s ease;
        }
        
        .form-input:focus + .floating-label,
        .form-input:not(:placeholder-shown) + .floating-label {
            transform: translateY(-28px) scale(0.85);
            color: #EF4444;
            background: white;
            padding: 0 8px;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-in {
            animation: slideIn 0.6s ease-out;
        }
        
        .pulse-warning {
            animation: pulse-warning 2s ease-in-out infinite;
        }
        
        @keyframes pulse-warning {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body >
    <div class="max-w-4xl mx-auto px-4 slide-in">
        <!-- Header Principal -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-red-500 rounded-2xl shadow-lg mb-6 pulse-warning">
                <i class="fas fa-arrow-up-from-bracket text-white text-3xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Modifier la Sortie</h1>
            <p class="text-gray-600 text-lg">Mettez à jour les informations de la sortie de stock</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Informative -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Carte Statut -->
             

                <!-- Carte Résumé -->
            

          
            </div>

            <!-- Formulaire Principal -->
            <div class="lg:col-span-3">
                <div class="gradient-border">
                    <div class="p-8">
                        <form action="{{ route('sortieupdate', $sortie->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

                            <!-- Section Produit -->
                            <div class="mb-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-1 h-6 bg-red-500 rounded-full mr-3"></div>
                                    <h3 class="text-xl font-semibold text-gray-800">Sélection du Produit</h3>
                                </div>
                                
                                <div class="relative">
                                    <select name="produit" 
                                            class="form-input w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 appearance-none bg-white">
                                        @foreach($listeProduit as $p)
                                        <option value="{{ $p->id }}" {{ $p->id == $sortie->produit_id ? 'selected' : '' }}>
                                            {{ $p->libelle }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Prix et Quantité -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <!-- Prix Unitaire -->
                                <div>
                                    <div class="flex items-center mb-6">
                                        <div class="w-1 h-6 bg-green-500 rounded-full mr-3"></div>
                                        <h3 class="text-xl font-semibold text-gray-800">Prix Unitaire</h3>
                                    </div>
                                    <div class="relative">
                                        <input type="number" 
                                               name="prix" 
                                               min="100" 
                                               value="{{ $sortie->prix }}" 
                                               required 
                                               class="form-input w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300 pr-16"
                                               placeholder=" ">
                                        <label class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                                            <i class="fas fa-money-bill-wave mr-2"></i>Prix unitaire
                                        </label>
                                        <span class="absolute right-4 top-4 text-gray-500 font-medium">FCFA</span>
                                    </div>
                                </div>

                                <!-- Quantité -->
                                <div>
                                    <div class="flex items-center mb-6">
                                        <div class="w-1 h-6 bg-blue-500 rounded-full mr-3"></div>
                                        <h3 class="text-xl font-semibold text-gray-800">Quantité</h3>
                                    </div>
                                    <div class="relative">
                                        <input type="number" 
                                               name="quantite" 
                                               min="0" 
                                               value="{{ $sortie->quantite }}" 
                                               required 
                                               class="form-input w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300"
                                               placeholder=" ">
                                        <label class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none">
                                            <i class="fas fa-boxes mr-2"></i>Quantité à sortir
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Section Date -->
                            <div class="mb-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-1 h-6 bg-purple-500 rounded-full mr-3"></div>
                                    <h3 class="text-xl font-semibold text-gray-800">Date de Sortie</h3>
                                </div>
                                
                                <div class="relative">
                                    <input type="date" 
                                           name="dateSortie" 
                                           value="{{ $sortie->dateSortie }}" 
                                           required 
                                           class="form-input w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-300">
                                </div>
                            </div>

                            <!-- Boutons d'Action -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                                <button type="button" 
                                        onclick="window.history.back();" 
                                        class="flex-1 py-4 bg-gradient-to-r from-gray-500 to-gray-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-times mr-3"></i>
                                    Annuler
                                </button>
                                <button type="submit" 
                                        name="enregistrer" 
                                        value="Enregistrer"
                                        class="flex-1 py-4 bg-gradient-to-r from-green-500 to-accent text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 flex items-center justify-center pulse-warning">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Bannière Informative -->
               
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des labels flottants
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                // Initialiser les labels pour les champs pré-remplis
                if (input.value) {
                    const label = input.nextElementSibling;
                    if (label && label.classList.contains('floating-label')) {
                        label.style.transform = 'translateY(-28px) scale(0.85)';
                        label.style.background = 'white';
                        label.style.padding = '0 8px';
                        label.style.color = '#EF4444';
                    }
                }

                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-red-200');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-red-200');
                });
            });

            // Validation des champs numériques
            const numberInputs = document.querySelectorAll('input[type="number"]');
            numberInputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value < 0) {
                        this.value = 0;
                    }
                    
                    // Validation spécifique pour le prix
                    if (this.name === 'prix' && this.value < 100) {
                        this.value = 100;
                    }
                });
            });

            // Effet de hover sur les cartes
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.transition = 'all 0.3s ease';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>

@endsection
