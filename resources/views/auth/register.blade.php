<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription SmartStock</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1D4ED8',
                        accent: '#10B981'
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
            margin: 0;
            padding: 20px;
        }
        
        .form-container {
            max-width: 440px;
            margin: 0 auto;
        }
        
        .floating-label {
            transition: all 0.3s ease;
        }
        
        .form-input:focus + .floating-label,
        .form-input:not(:placeholder-shown) + .floating-label {
            transform: translateY(-22px) scale(0.85);
            color: #3B82F6;
            background: white;
            padding: 0 6px;
            margin-left: 6px;
        }
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
            background: #E5E7EB;
        }
        
        .strength-weak { background: #EF4444; width: 25%; }
        .strength-fair { background: #F59E0B; width: 50%; }
        .strength-good { background: #10B981; width: 75%; }
        .strength-strong { background: #10B981; width: 100%; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        /* Style pour le modal des conditions */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 0;
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="flex items-center justify-center">
    <div class="form-container fade-in">
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <!-- En-tête compact -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-primary to-secondary rounded-2xl mb-3">
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Créer un compte</h1>
                <p class="text-gray-600 text-sm">Rejoignez SmartStock Gestion_stock</p>
            </div>

            <form action="{{ route('register') }}" method="POST" id="registerForm">
                @csrf

                <!-- Nom et Prénom -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div class="relative">
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}" 
                               required
                               class="form-input w-full px-3 py-3 border border-gray-300 rounded-lg focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-200"
                               placeholder=" ">
                        <label for="name" class="floating-label absolute left-3 top-3 text-gray-500 text-sm pointer-events-none">
                            Nom
                        </label>
                    </div>

                    <div class="relative">
                        <input type="text" 
                               name="prenom" 
                               id="prenom" 
                               value="{{ old('prenom') }}" 
                               required
                               class="form-input w-full px-3 py-3 border border-gray-300 rounded-lg focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-200"
                               placeholder=" ">
                        <label for="prenom" class="floating-label absolute left-3 top-3 text-gray-500 text-sm pointer-events-none">
                            Prénom
                        </label>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}" 
                               required
                               class="form-input w-full px-3 py-3 border border-gray-300 rounded-lg focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-200"
                               placeholder=" ">
                        <label for="email" class="floating-label absolute left-3 top-3 text-gray-500 text-sm pointer-events-none">
                            <i class="fas fa-envelope mr-1"></i>Email
                        </label>
                    </div>
                </div>

                <!-- Mot de passe -->
                <div class="mb-3">
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               required
                               class="form-input w-full px-3 py-3 border border-gray-300 rounded-lg focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-200 pr-10"
                               placeholder=" "
                               onkeyup="checkPasswordStrength()">
                        <label for="password" class="floating-label absolute left-3 top-3 text-gray-500 text-sm pointer-events-none">
                            <i class="fas fa-lock mr-1"></i>Mot de passe
                        </label>
                        <button type="button" 
                                onclick="togglePassword('password')" 
                                class="absolute right-3 top-3 text-gray-400 hover:text-primary transition-colors">
                            <i class="fas fa-eye text-sm" id="passwordToggle"></i>
                        </button>
                    </div>
                    <!-- Indicateur de force -->
                    <div class="mt-2">
                        <div class="password-strength" id="passwordStrength"></div>
                        <div class="text-xs text-gray-500 mt-1" id="passwordStrengthText">Faible</div>
                    </div>
                </div>

                <!-- Confirmation mot de passe -->
                <div class="mb-4">
                    <div class="relative">
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               required
                               class="form-input w-full px-3 py-3 border border-gray-300 rounded-lg focus:border-primary focus:ring-1 focus:ring-primary transition-all duration-200 pr-10"
                               placeholder=" "
                               onkeyup="checkPasswordMatch()">
                        <label for="password_confirmation" class="floating-label absolute left-3 top-3 text-gray-500 text-sm pointer-events-none">
                            <i class="fas fa-lock mr-1"></i>Confirmation
                        </label>
                        <button type="button" 
                                onclick="togglePassword('password_confirmation')" 
                                class="absolute right-3 top-3 text-gray-400 hover:text-primary transition-colors">
                            <i class="fas fa-eye text-sm" id="passwordConfirmToggle"></i>
                        </button>
                    </div>
                    <div class="text-xs mt-1 flex items-center" id="passwordMatchText"></div>
                </div>

                <!-- Conditions -->
                <div class="flex items-center mb-4 p-2 bg-blue-50 rounded-lg">
                    <input type="checkbox" 
                           name="terms" 
                           id="terms" 
                           required
                           class="rounded border-gray-300 text-primary focus:ring-primary w-4 h-4">
                    <label for="terms" class="ml-2 text-xs text-gray-700">
                        J'accepte les 
                        <button type="button" onclick="openConditionsModal()" class="text-primary font-medium hover:text-secondary underline focus:outline-none">
                            conditions d'utilisation
                        </button>
                    </label>
                </div>

                <!-- Bouton d'inscription -->
                <button type="submit" 
                        class="w-full py-3 bg-gradient-to-r from-primary to-secondary text-white font-medium rounded-lg hover:shadow-lg transition-all duration-200 mb-3">
                    <i class="fas fa-user-plus mr-2"></i>
                    Créer mon compte
                </button>

                <!-- Lien de connexion -->
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        Déjà un compte ? 
                        <a href="{{ route('login') }}" class="text-primary font-medium hover:text-secondary transition-colors">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal des Conditions d'Utilisation -->
    <div id="conditionsModal" class="modal-overlay">
        <div class="modal-content">
            <!-- En-tête du modal -->
            <div class="bg-gradient-to-r from-primary to-secondary px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">
                        <i class="fas fa-file-contract mr-2"></i>
                        Conditions d'Utilisation
                    </h3>
                    <button onclick="closeConditionsModal()" class="text-white hover:text-gray-200 text-xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Contenu du modal -->
            <div class="p-6 max-h-96 overflow-y-auto">
                <div class="space-y-4 text-sm text-gray-700">
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">1. Acceptation des conditions</h4>
                        <p>En utilisant SmartStock Gestion_stock, vous acceptez les présentes conditions d'utilisation.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">2. Compte utilisateur</h4>
                        <p>Vous êtes responsable de la confidentialité de votre compte et de votre mot de passe.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">3. Utilisation du service</h4>
                        <p>Le service est destiné à la gestion de stock et ne doit pas être utilisé à des fins illégales.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">4. Propriété intellectuelle</h4>
                        <p>Tous les droits de propriété intellectuelle relatifs au service sont réservés.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">5. Confidentialité</h4>
                        <p>Vos données sont protégées conformément à notre politique de confidentialité.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">6. Limitations</h4>
                        <p>Le service est fourni "tel quel" sans garantie d'aucune sorte.</p>
                    </div>

                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">7. Modifications</h4>
                        <p>Nous nous réservons le droit de modifier ces conditions à tout moment.</p>
                    </div>
                </div>
            </div>

            <!-- Pied du modal -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <input type="checkbox" id="modalTerms" class="rounded border-gray-300 text-primary focus:ring-primary w-4 h-4">
                        <label for="modalTerms" class="ml-2 text-sm text-gray-700">
                            J'ai lu et j'accepte les conditions
                        </label>
                    </div>
                    <div class="flex space-x-3">
                        <button onclick="closeConditionsModal()" 
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm">
                            Fermer
                        </button>
                        <button onclick="acceptConditions()" 
                                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors text-sm">
                            Accepter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId === 'password' ? 'passwordToggle' : 'passwordConfirmToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Vérification de la force du mot de passe
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            
            let strength = 0;
            let text = '';
            let className = '';

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/\d/)) strength++;
            if (password.match(/[^a-zA-Z\d]/)) strength++;

            switch(strength) {
                case 0:
                case 1:
                    text = 'Faible';
                    className = 'strength-weak';
                    break;
                case 2:
                    text = 'Moyen';
                    className = 'strength-fair';
                    break;
                case 3:
                    text = 'Bon';
                    className = 'strength-good';
                    break;
                case 4:
                    text = 'Fort';
                    className = 'strength-strong';
                    break;
            }

            strengthBar.className = `password-strength ${className}`;
            strengthText.textContent = text;
            strengthText.className = `text-xs mt-1 ${strength >= 3 ? 'text-green-600' : strength === 2 ? 'text-yellow-600' : 'text-red-600'}`;
        }

        // Vérification de la correspondance des mots de passe
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchText = document.getElementById('passwordMatchText');
            
            if (confirmPassword === '') {
                matchText.innerHTML = '';
                matchText.className = 'text-xs mt-1 flex items-center';
            } else if (password === confirmPassword) {
                matchText.innerHTML = '<i class="fas fa-check-circle text-green-500 mr-1"></i> Correspondent';
                matchText.className = 'text-xs mt-1 flex items-center text-green-600';
            } else {
                matchText.innerHTML = '<i class="fas fa-times-circle text-red-500 mr-1"></i> Ne correspondent pas';
                matchText.className = 'text-xs mt-1 flex items-center text-red-600';
            }
        }

        // Gestion du modal des conditions
        function openConditionsModal() {
            document.getElementById('conditionsModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeConditionsModal() {
            document.getElementById('conditionsModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function acceptConditions() {
            const modalCheckbox = document.getElementById('modalTerms');
            const mainCheckbox = document.getElementById('terms');
            
            if (modalCheckbox.checked) {
                mainCheckbox.checked = true;
                closeConditionsModal();
                Swal.fire({
                    icon: 'success',
                    title: 'Conditions acceptées',
                    text: 'Vous avez accepté les conditions d\'utilisation',
                    confirmButtonColor: '#3B82F6',
                    background: '#fff',
                    color: '#1F2937',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: 'Veuillez cocher la case pour accepter les conditions',
                    confirmButtonColor: '#3B82F6',
                    background: '#fff',
                    color: '#1F2937'
                });
            }
        }

        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('conditionsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeConditionsModal();
            }
        });

        // Gestion de la soumission du formulaire
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const termsCheckbox = document.getElementById('terms');
            if (!termsCheckbox.checked) {
                Swal.fire({
                    icon: 'error',
                    title: 'Conditions requises',
                    text: 'Veuillez accepter les conditions d\'utilisation',
                    confirmButtonColor: '#3B82F6',
                    background: '#fff',
                    color: '#1F2937'
                });
                return;
            }
            
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Animation de chargement
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Création...';
            submitButton.disabled = true;
            
            setTimeout(() => {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                
                if (password !== confirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Les mots de passe ne correspondent pas',
                        confirmButtonColor: '#3B82F6',
                        background: '#fff',
                        color: '#1F2937',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                    return;
                }
                
                // Si tout est valide
                this.submit();
            }, 1000);
        });

        // Gestion des erreurs Laravel
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{!! $errors->first() !!}',
                    confirmButtonColor: '#3B82F6',
                    background: '#fff',
                    color: '#1F2937'
                });
            });
        @endif

        // Animation des labels
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                if (input.value) {
                    const label = input.nextElementSibling;
                    if (label && label.classList.contains('floating-label')) {
                        label.style.transform = 'translateY(-22px) scale(0.85)';
                        label.style.background = 'white';
                        label.style.padding = '0 6px';
                        label.style.marginLeft = '6px';
                        label.style.color = '#3B82F6';
                    }
                }
            });
        });
    </script>
</body>
</html>