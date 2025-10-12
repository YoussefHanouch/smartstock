@extends('layouts.app')

@section('categ')

@section('content')
 <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 py-12">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête avec icône colorée -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class='bx bx-plus text-2xl text-white'></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Ajouter une Catégorie</h1>
            <p class="text-gray-600">Créez une nouvelle catégorie pour organiser vos produits</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 backdrop-blur-sm bg-white/80">
            <form action="{{ route('persistcategorie') }}" method="post">
                @csrf
                
                <div class="space-y-6">
                    <!-- Champ de saisie -->
                    <div>
                        <label for="categorie" class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class='bx bx-tag text-blue-500 mr-2'></i>
                            Nom de la catégorie
                        </label>
                        <input 
                            type="text" 
                            id="categorie" 
                            name="categorie" 
                            value="{{ old('categorie') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('categorie') border-red-300 focus:ring-red-500 @enderror"
                            placeholder="Ex: Électronique, Maison, Sport..."
                            required
                        >
                        @error('categorie')
                        <div class="mt-2 text-red-600 text-sm flex items-center space-x-1">
                            <i class='bx bx-error-circle'></i>
                            <span>{{ $message }}</span>
                        </div>
                        @enderror
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex space-x-3 pt-4">
                        <a 
                            href="{{ route('listcategorie') }}" 
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-3 px-4 rounded-xl font-medium transition-colors duration-200 flex items-center justify-center space-x-2"
                        >
                            <i class='bx bx-arrow-back'></i>
                            <span>Retour</span>
                        </a>
                        <button 
                            type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-3 px-4 rounded-xl font-medium transition-all duration-200 hover:shadow-lg flex items-center justify-center space-x-2"
                        >
                            <i class='bx bx-check'></i>
                            <span>Créer</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tips card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-2xl p-4">
            <div class="flex items-start space-x-3">
                <div class="bg-blue-100 rounded-lg p-2">
                    <i class='bx bx-bulb text-blue-600'></i>
                </div>
                <div>
                    <h4 class="font-medium text-blue-900 mb-1">Astuce</h4>
                    <p class="text-sm text-blue-700">
                        Utilisez des noms courts et descriptifs pour une meilleure organisation.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('categorie');
        
        // Animation au focus
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-blue-100');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-blue-100');
        });
        
        // Validation visuelle
        input.addEventListener('input', function() {
            const isValid = this.value.length >= 2;
            if (isValid) {
                this.classList.add('border-green-400');
                this.classList.remove('border-gray-200');
            } else {
                this.classList.remove('border-green-400');
                this.classList.add('border-gray-200');
            }
        });
    });
</script>