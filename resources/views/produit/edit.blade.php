@extends('layouts.app')

@section('prod')

@section('content')


    <title>Modifier un produit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#007bff',
                        secondary: '#6c757d',
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
        
        .card-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .form-input {
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.1);
        }
        
        .btn-hover {
            transition: all 0.3s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>

    <div class="max-w-2xl mx-auto px-4 fade-in">
        <!-- En-tête de page -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Modifier un produit</h1>
            <p class="text-gray-600">Mettez à jour les informations de votre produit</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white rounded-2xl card-shadow overflow-hidden">
            <!-- En-tête de la carte -->
            <div class="bg-gradient-to-r from-primary to-blue-600 px-6 py-5">
                <div class="flex items-center justify-center">
                    <i class="fas fa-edit text-white text-2xl mr-3"></i>
                    <h2 class="text-xl font-semibold text-white">Modification du produit</h2>
                </div>
            </div>

            <!-- Corps de la carte -->
            <div class="p-6 md:p-8">
                <form action="{{ route('updateproduit') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $produit->id }}">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    
                    <!-- Champ Libellé -->
                    <div class="mb-6">
                        <label for="libelle" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-primary"></i>Libellé du produit
                        </label>
                        <input type="text" 
                               id="libelle" 
                               name="libelle" 
                               value="{{ $produit->libelle }}" 
                               required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Entrez le libellé du produit">
                    </div>
                    
                    <!-- Champ Catégorie -->
                    <div class="mb-6">
                        <label for="categorie" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-layer-group mr-2 text-primary"></i>Catégorie
                        </label>
                        <select id="categorie" 
                                name="categorie" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            @foreach($listcategorie as $c)
                            <option value="{{ $c->id }}" {{ $produit->categorie_id == $c->id ? 'selected' : '' }}>
                                {{ $c->nomCategorie }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Champ Stock -->
                    <div class="mb-8">
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-boxes mr-2 text-primary"></i>Stock disponible
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="stock" 
                                   name="stock" 
                                   min="0" 
                                   value="{{ $produit->stock }}" 
                                   required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl form-input focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="Quantité en stock">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500">unités</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button type="submit" 
                                name="modifier" 
                                class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-success to-green-600 text-white font-medium rounded-xl btn-hover transition-all duration-300">
                            <i class="fas fa-save mr-2"></i>
                            Mettre à jour
                        </button>
                        <a href="{{ route('listproduit') }}" 
                           class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-danger to-red-600 text-white font-medium rounded-xl btn-hover transition-all duration-300 text-center">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
            
            <!-- Pied de carte -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="text-center text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tous les champs marqués d'un astérisque (*) sont obligatoires
                </div>
            </div>
        </div>
        
        <!-- Informations supplémentaires -->
       
        </div>
    </div>

    <script>
        // Animation pour les champs de formulaire
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-primary', 'ring-opacity-20');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-primary', 'ring-opacity-20');
                });
            });
            
            // Validation du stock
            const stockInput = document.getElementById('stock');
            stockInput.addEventListener('input', function() {
                if (this.value < 0) {
                    this.value = 0;
                }
            });
        });
    </script>
</body>
</html>

@endsection
