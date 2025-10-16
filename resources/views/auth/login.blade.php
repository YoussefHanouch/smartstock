<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - StockFlow</title>
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
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-label {
            transition: all 0.3s ease;
        }
        
        .form-input:focus + .floating-label,
        .form-input:not(:placeholder-shown) + .floating-label {
            transform: translateY(-25px) scale(0.85);
            color: #3B82F6;
            background: white;
            padding: 0 8px;
            margin-left: 8px;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            to { box-shadow: 0 0 30px rgba(59, 130, 246, 0.8); }
        }
        
        .slide-in {
            animation: slideIn 0.6s ease-out;
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
        
        .bounce-in {
            animation: bounceIn 0.8s ease-out;
        }
        
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape-3 {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
    </style>
</head>
<body>
    <!-- Animation de fond -->
    <div class="background-animation">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <div class="login-container">
        <div class="w-full max-w-md mx-auto">
            <!-- Carte de connexion centrée -->
            <div class="bounce-in">
                <div class="bg-white rounded-3xl shadow-2xl p-8 mx-4">
                    <!-- En-tête centré -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-primary to-secondary rounded-2xl mb-4 pulse-glow floating">
                            <i class="fas fa-warehouse text-white text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Bienvenue</h1>
                        <p class="text-gray-600">Connectez-vous à votre compte</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Champ Email -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       required 
                                       autofocus
                                       class="form-input w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-300"
                                       placeholder=" ">
                                <label for="email" class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none transition-all duration-300">
                                    <i class="fas fa-envelope mr-2"></i>Adresse e-mail
                                </label>
                                <div class="absolute right-4 top-4">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Champ Mot de passe -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       required 
                                       autocomplete="current-password"
                                       class="form-input w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-300 pr-12"
                                       placeholder=" ">
                                <label for="password" class="floating-label absolute left-4 top-4 text-gray-500 pointer-events-none transition-all duration-300">
                                    <i class="fas fa-lock mr-2"></i>Mot de passe
                                </label>
                                <button type="button" 
                                        onclick="togglePassword()" 
                                        class="absolute right-4 top-4 text-gray-400 hover:text-primary transition-colors">
                                    <i class="fas fa-eye" id="passwordToggle"></i>
                                </button>
                            </div>
                        </div>

                    

                        <!-- Bouton de connexion -->
                        <button type="submit" 
                                class="w-full py-4 bg-gradient-to-r from-primary to-secondary text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 transform mb-4">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Se connecter
                        </button>

                        <!-- Lien d'inscription -->
                        <div class="text-center">
                            <p class="text-gray-600">
                                Pas encore de compte ? 
                                <a href="{{ route('register') }}" class="text-primary hover:text-secondary font-semibold transition-colors">
                                    Créer un compte
                                </a>
                            </p>
                        </div>
                    </form>

                    <!-- Séparateur -->
            

                <!-- Footer -->
               
            </div>
        </div>
    </div>

    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }

        // Gestion de la soumission du formulaire avec SweetAlert
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Animation de chargement
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Connexion...';
            submitButton.disabled = true;
            
            // Simulation d'envoi (remplacez par votre logique réelle)
            setTimeout(() => {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                // Simulation de validation
                if (email && password) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Connexion réussie !',
                        text: 'Redirection vers votre tableau de bord...',
                        timer: 2000,
                        showConfirmButton: false,
                        background: '#fff',
                        color: '#1F2937',
                        willClose: () => {
                            // Ici vous redirigez vers le dashboard
                            // window.location.href = '/dashboard';
                            this.submit(); // Soumission réelle du formulaire
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur de connexion',
                        text: 'Veuillez remplir tous les champs',
                        confirmButtonColor: '#3B82F6',
                        background: '#fff',
                        color: '#1F2937'
                    });
                    
                    // Réactiver le bouton
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }
            }, 1500);
        });

        // Gestion des erreurs Laravel (si présentes dans la page)
        @if($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur de connexion',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#3B82F6',
                    background: '#fff',
                    color: '#1F2937'
                });
            });
        @endif

        // Animation des labels pour les champs pré-remplis
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                if (input.value) {
                    const label = input.nextElementSibling;
                    if (label && label.classList.contains('floating-label')) {
                        label.style.transform = 'translateY(-25px) scale(0.85)';
                        label.style.background = 'white';
                        label.style.padding = '0 8px';
                        label.style.marginLeft = '8px';
                        label.style.color = '#3B82F6';
                    }
                }

                // Effet de focus amélioré
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-primary/20', 'rounded-xl');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-primary/20', 'rounded-xl');
                });
            });
        });

        // Effet de particules flottantes en arrière-plan
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.background-animation');
            const colors = ['rgba(255,255,255,0.1)', 'rgba(255,255,255,0.05)', 'rgba(255,255,255,0.15)'];
            
            for (let i = 0; i < 8; i++) {
                const shape = document.createElement('div');
                shape.className = 'floating-shape';
                shape.style.width = Math.random() * 100 + 50 + 'px';
                shape.style.height = shape.style.width;
                shape.style.background = colors[Math.floor(Math.random() * colors.length)];
                shape.style.top = Math.random() * 100 + '%';
                shape.style.left = Math.random() * 100 + '%';
                shape.style.animationDelay = Math.random() * 6 + 's';
                shape.style.animationDuration = (Math.random() * 4 + 4) + 's';
                container.appendChild(shape);
            }
        });
    </script>
</body>
</html>