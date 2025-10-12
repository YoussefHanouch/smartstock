@extends('layouts.app')

@section('categ')

@section('content')
 <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-md mx-auto">
        <!-- En-tête -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Modifier la Catégorie</h1>
            <p class="text-gray-600">Mettez à jour les informations de la catégorie</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- En-tête de la carte -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-center space-x-3">
                    <i class='bx bx-category text-2xl text-white'></i>
                    <h2 class="text-xl font-semibold text-white">Édition de Catégorie</h2>
                </div>
            </div>

            <!-- Corps du formulaire -->
            <div class="p-6">
                <form action="{{ route('updatecategorie', ['id' => $category->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <!-- Champ Nom de la Catégorie -->
                    <div class="mb-6">
                        <label for="categorie" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la Catégorie
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="categorie" 
                                name="categorie" 
                                value="{{ old('categorie', $category->nomCategorie) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('categorie') border-red-500 focus:ring-red-500 @enderror"
                                placeholder="Entrez le nom de la catégorie"
                                required
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class='bx bx-category text-gray-400'></i>
                            </div>
                        </div>
                        @error('categorie')
                        <div class="flex items-center space-x-2 mt-2 text-red-600 text-sm">
                            <i class='bx bx-error-circle'></i>
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex space-x-3 pt-4">
                        <button 
                            type="submit" 
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-200 flex items-center justify-center space-x-2"
                        >
                            <i class='bx bx-save'></i>
                            <span>Enregistrer</span>
                        </button>
                        <a 
                            href="{{ route('listcategorie') }}" 
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-200 flex items-center justify-center space-x-2"
                        >
                            <i class='bx bx-x'></i>
                            <span>Annuler</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Informations supplémentaires -->
        <div class="mt-6 text-center">
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-center justify-center space-x-2 text-blue-700">
                    <i class='bx bx-info-circle'></i>
                    <span class="text-sm font-medium">Tous les produits associés seront mis à jour</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .bg-gradient-to-r {
        background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);
    }
    
    .shadow-sm {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }
    
    .transition-colors {
        transition: all 0.2s ease-in-out;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'entrée
        const formCard = document.querySelector('.bg-white');
        formCard.style.opacity = '0';
        formCard.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            formCard.style.transition = 'all 0.5s ease-out';
            formCard.style.opacity = '1';
            formCard.style.transform = 'translateY(0)';
        }, 100);

        // Validation en temps réel
        const categorieInput = document.getElementById('categorie');
        categorieInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.classList.remove('border-gray-300');
                this.classList.add('border-green-500');
            } else {
                this.classList.remove('border-green-500');
                this.classList.add('border-gray-300');
            }
        });
    });
</script>