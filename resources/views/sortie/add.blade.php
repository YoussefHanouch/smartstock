@extends('layouts.app')

@section('sortie')
<script src="https://cdn.tailwindcss.com"></script>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#667eea',
                    secondary: '#764ba2',
                    accent: '#f093fb'
                }
            }
        }
    }
</script>

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        <!-- En-tête -->
        <div class="text-center mb-8">
            <div class="bg-white rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class='bx bx-log-out text-3xl text-blue-600'></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Nouvelle Sortie</h1>
            <p class="text-gray-600 text-lg">Enregistrez une nouvelle vente ou sortie de produit</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- En-tête de la carte -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                <div class="flex items-center space-x-3">
                    <i class='bx bx-cart text-2xl text-white'></i>
                    <h2 class="text-xl font-semibold text-white">Détails de la Sortie</h2>
                </div>
            </div>

            <!-- Corps du formulaire -->
            <div class="p-8">
                <form action="{{ route('persistsortieproduit') }}" method="post">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Produit -->
                        <div>
                            <label for="produit" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class='bx bx-package text-blue-500 mr-2'></i>
                                Produit
                            </label>
                            <select name="produit" id="produit" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('produit') border-red-500 @enderror">
                                @foreach($listeProduit as $p)
                                <option value="{{ $p->id }}">{{ $p->libelle }}</option>
                                @endforeach
                            </select>
                            @error('produit')
                            <div class="flex items-center space-x-2 mt-2 text-red-600 text-sm">
                                <i class='bx bx-error-circle'></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Prix et Quantité en ligne -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Prix Unitaire -->
                            <div>
                                <label for="prix" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <i class='bx bx-money text-green-500 mr-2'></i>
                                    Prix Unitaire (DH)
                                </label>
                                <input type="number" name="prix" min="0" step="0.01" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('prix') border-red-500 @enderror" 
                                       required placeholder="0.00"
                                       oninput="calculateTotal()">
                                @error('prix')
                                <div class="flex items-center space-x-2 mt-2 text-red-600 text-sm">
                                    <i class='bx bx-error-circle'></i>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>

                            <!-- Quantité -->
                            <div>
                                <label for="quantite" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <i class='bx bx-layer text-orange-500 mr-2'></i>
                                    Quantité
                                </label>
                                <input type="number" name="quantite" min="1" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 @error('quantite') border-red-500 @enderror" 
                                       required placeholder="0"
                                       oninput="calculateTotal()">
                                @error('quantite')
                                <div class="flex items-center space-x-2 mt-2 text-red-600 text-sm">
                                    <i class='bx bx-error-circle'></i>
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Total calculé -->
                        <div id="totalSection" class="hidden">
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-blue-700 font-semibold">Total:</span>
                                    <span id="totalAmount" class="text-2xl font-bold text-blue-700">0.00 DH</span>
                                </div>
                            </div>
                        </div>

                        <!-- Nom Client -->
                        <div>
                            <label for="nom_client" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class='bx bx-user text-purple-500 mr-2'></i>
                                Nom du Client
                            </label>
                            <input type="text" name="nom_client" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 @error('nom_client') border-red-500 @enderror" 
                                   required placeholder="Entrez le nom du client">
                            @error('nom_client')
                            <div class="flex items-center space-x-2 mt-2 text-red-600 text-sm">
                                <i class='bx bx-error-circle'></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Date de Sortie -->
                        <div>
                            <label for="dateSortie" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <i class='bx bx-calendar text-red-500 mr-2'></i>
                                Date de Sortie
                            </label>
                            <input type="date" name="dateSortie" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 @error('dateSortie') border-red-500 @enderror" 
                                   required>
                            @error('dateSortie')
                            <div class="flex items-center space-x-2 mt-2 text-red-600 text-sm">
                                <i class='bx bx-error-circle'></i>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Champ caché user_id -->
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

                        <!-- Bouton de soumission -->
                        <div class="pt-6">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-4 px-6 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center space-x-3">
                                <i class='bx bx-check-circle text-xl'></i>
                                <span>Enregistrer la Sortie</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lien de retour -->
        <div class="text-center mt-8">
            <a href="{{ route('listsortie') }}" 
               class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                <i class='bx bx-arrow-back'></i>
                <span>Retour à la liste des sorties</span>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Définir la date d'aujourd'hui par défaut
        const today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="dateSortie"]').value = today;

        // Animation d'entrée
        const formCard = document.querySelector('.bg-white');
        formCard.style.opacity = '0';
        formCard.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            formCard.style.transition = 'all 0.5s ease-out';
            formCard.style.opacity = '1';
            formCard.style.transform = 'translateY(0)';
        }, 100);
    });

    function calculateTotal() {
        const prix = parseFloat(document.querySelector('input[name="prix"]').value) || 0;
        const quantite = parseInt(document.querySelector('input[name="quantite"]').value) || 0;
        const total = prix * quantite;
        
        const totalSection = document.getElementById('totalSection');
        const totalAmount = document.getElementById('totalAmount');
        
        if (prix > 0 && quantite > 0) {
            totalAmount.textContent = total.toFixed(2) + ' DH';
            totalSection.classList.remove('hidden');
        } else {
            totalSection.classList.add('hidden');
        }
    }

    // Validation en temps réel
    document.querySelectorAll('input, select').forEach(element => {
        element.addEventListener('input', function() {
            if (this.value && this.value.length > 0) {
                this.classList.remove('border-gray-300');
                this.classList.add('border-green-500');
            } else {
                this.classList.remove('border-green-500');
                this.classList.add('border-gray-300');
            }
        });
    });
</script>

<style>
    .bg-gradient-to-br {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    }
    
    .shadow-xl {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .transition-all {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    input:focus, select:focus {
        outline: none;
        ring: 2px;
    }
</style>



@endsection