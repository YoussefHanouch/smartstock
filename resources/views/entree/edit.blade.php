@extends('layouts.app')

@section('entre')
@section('content')
  <title>Modifier une entrée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#62A1D9',
                        secondary: '#4A8EB7',
                        success: '#28a745',
                        danger: '#dc3545',
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
            min-height: 100vh;
        }
        
        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        
        .form-input {
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }
        
        .form-input:focus {
            border-color: #62A1D9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(98, 161, 217, 0.2);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            transition: all 0.3s ease;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            transition: all 0.3s ease;
        }
        
        .btn-success:hover, .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .header-gradient {
            background: linear-gradient(135deg, #62A1D9 0%, #4A8EB7 100%);
        }
    </style>
</head>
<body >
    <div class="max-w-2xl mx-auto px-4 fade-in-up">
        <!-- En-tête de page -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 header-gradient rounded-full mb-4">
                <i class="fas fa-edit text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Modifier une entrée de produit</h1>
            <p class="text-gray-600">Mettez à jour les informations de l'entrée de stock</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card p-6 md:p-8">
            <!-- En-tête de la carte -->
            <div class="header-gradient rounded-xl -mt-8 -mx-6 mb-6 p-6 text-white">
                <div class="flex items-center justify-center">
                    <i class="fas fa-boxes text-white text-2xl mr-3"></i>
                    <h2 class="text-xl font-semibold">Modification d'entrée #{{ $entree->id }}</h2>
                </div>
            </div>

            <form action="{{ route('updateentree') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $entree->id }}">
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                
                <!-- Champ Produit -->
                <div class="mb-6">
                    <label for="produit" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-cube mr-2 text-primary"></i>Produit
                    </label>
                    <div class="relative">
                        <select id="produit" 
                                name="produit" 
                                class="form-input w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary appearance-none">
                            @foreach($listproduit as $p)
                            <option value="{{ $p->id }}" {{ $p->id == $entree->produit_id ? 'selected' : '' }}>
                                {{ $p->libelle }}
                            </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Champs Quantité et Prix -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="quantite" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-boxes mr-2 text-primary"></i>Quantité
                        </label>
                        <input type="number" 
                               id="quantite" 
                               name="quantite" 
                               min="0" 
                               value="{{ $entree->quantite }}" 
                               required 
                               class="form-input w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                               placeholder="Quantité">
                    </div>
                    
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-money-bill-wave mr-2 text-primary"></i>Prix unitaire
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="prix" 
                                   name="prix" 
                                   min="0" 
                                   value="{{ $entree->prix }}" 
                                   required 
                                   class="form-input w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary"
                                   placeholder="Prix">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500">FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Champ Date -->
                <div class="mb-8">
                    <label for="dateEntree" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt mr-2 text-primary"></i>Date d'entrée
                    </label>
                    <input type="date" 
                           id="dateEntree" 
                           name="dateEntree" 
                           value="{{ $entree->dateEntree }}" 
                           required 
                           class="form-input w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit" 
                            name="modifier" 
                            value="Modifier"
                            class="btn-success flex-1 py-4 text-white font-semibold rounded-xl inline-flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Mettre à jour
                    </button>
                    <a href="{{ route('listentree') }}" 
                       class="btn-danger flex-1 py-4 text-white font-semibold rounded-xl inline-flex items-center justify-center text-center">
                        <i class="fas fa-times mr-2"></i>
                        Annuler
                    </a>
                </div>
            </form>
        </div>



        <!-- Résumé de l'entrée -->
    

    <script>
        // Animation et interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des champs au focus
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-primary', 'ring-opacity-20', 'rounded-xl');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-primary', 'ring-opacity-20', 'rounded-xl');
                });
            });

            // Validation des champs numériques
            const numberInputs = document.querySelectorAll('input[type="number"]');
            numberInputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value < 0) {
                        this.value = 0;
                    }
                });
            });

            // Calcul automatique de la valeur totale
            const quantiteInput = document.getElementById('quantite');
            const prixInput = document.getElementById('prix');
            
            function updateTotalValue() {
                const quantite = parseInt(quantiteInput.value) || 0;
                const prix = parseInt(prixInput.value) || 0;
                const totalValue = quantite * prix;
                
                // Mettre à jour l'affichage de la valeur totale
                const totalElement = document.querySelector('.text-purple-600.text-xl');
                if (totalElement) {
                    totalElement.textContent = totalValue + ' FCFA';
                }
            }
            
            quantiteInput.addEventListener('input', updateTotalValue);
            prixInput.addEventListener('input', updateTotalValue);
        });
    </script>
@endsection
