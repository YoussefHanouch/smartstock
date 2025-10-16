<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestionStock - SmartStock</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts & Icons -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #27ae60;
            --warning: #f39c12;
            --sidebar-width: 280px;
            --header-height: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            color: #333;
        }
        
        /* ===== LAYOUT PRINCIPAL ===== */
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* ===== OPTION 1: MENU MODERNE AVEC GRADIENTS ===== */
        .modern-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .sidebar-header {
            padding: 30px 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .brand i {
            color: #e74c3c;
            font-size: 2rem;
        }
        
        .modern-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            margin: 8px 15px;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .menu-link {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .menu-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(10px);
        }
        
        .menu-link.active {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        
        .menu-icon {
            font-size: 1.3rem;
            margin-right: 15px;
            width: 25px;
            text-align: center;
        }
        
        .menu-text {
            font-weight: 500;
            font-size: 1rem;
        }
        
        .menu-badge {
            background: #e74c3c;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            margin-left: auto;
        }
        
        .logout-section {
            margin-top: 30px;
            padding: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px 20px;
            background: rgba(231, 76, 60, 0.2);
            color: white;
            border: 1px solid rgba(231, 76, 60, 0.3);
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .logout-btn:hover {
            background: #e74c3c;
            transform: translateY(-2px);
        }
        
        /* ===== CONTENU PRINCIPAL ===== */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background: #f8f9fa;
        }
        
        .top-header {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        .content-area {
            padding: 30px;
            min-height: calc(100vh - 70px);
        }
        
        /* ===== OPTION 2: MENU HORIZONTAL SUPÉRIEUR ===== */
        .horizontal-nav {
            background: white;
            padding: 0 30px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            /* Caché par défaut sur mobile */
            display: none;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .nav-item {
            position: relative;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 20px 25px;
            color: var(--dark);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            gap: 10px;
        }
        
        .nav-link:hover {
            color: var(--secondary);
            background: #f8f9fa;
        }
        
        .nav-link.active {
            color: var(--secondary);
            border-bottom: 3px solid var(--secondary);
        }
        
        /* ===== MENU MOBILE ===== */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark);
            cursor: pointer;
        }
        
        .mobile-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -2px 20px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        
        .mobile-nav-items {
            display: flex;
            list-style: none;
            justify-content: space-around;
            padding: 10px 0;
        }
        
        .mobile-nav-item {
            flex: 1;
            text-align: center;
        }
        
        .mobile-nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 8px 5px;
            text-decoration: none;
            color: var(--dark);
            font-size: 0.7rem;
            transition: all 0.3s ease;
            border-radius: 8px;
        }
        
        .mobile-nav-link i {
            font-size: 1.2rem;
            margin-bottom: 4px;
        }
        
        .mobile-nav-link.active {
            color: var(--secondary);
            background: rgba(52, 152, 219, 0.1);
        }
        
        /* ===== OVERLAY MOBILE ===== */
        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        
        /* ===== RESPONSIVE ===== */
        
        /* Tablettes et petits écrans (1024px et moins) */
        @media (min-width: 769px) and (max-width: 1024px) {
            .modern-sidebar {
                transform: translateX(-100%);
            }
            
            .modern-sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            /* Afficher le menu horizontal sur tablette */
            .horizontal-nav {
                display: block;
            }
            
            .mobile-menu-btn {
                display: block;
            }
        }
        
        /* PC (1025px et plus) */
        @media (min-width: 1025px) {
            .horizontal-nav {
                display: none; /* Cacher sur PC */
            }
        }
        
        /* Mobile (768px et moins) */
        @media (max-width: 768px) {
            .modern-sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .modern-sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .horizontal-nav {
                display: none; /* Cacher sur mobile */
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .mobile-nav {
                display: block;
            }
            
            .content-area {
                padding: 20px 15px;
                padding-bottom: 80px;
            }
            
            .top-header {
                padding: 15px 20px;
            }
        }
        
        /* Petit mobile (480px et moins) */
        @media (max-width: 480px) {
            .mobile-nav-link {
                font-size: 0.65rem;
            }
            
            .mobile-nav-link i {
                font-size: 1.1rem;
            }
            
            nav {
                padding: 15px 20px;
            }
            
            .content-area {
                padding: 15px 10px;
                padding-bottom: 70px;
            }
        }
        
        /* ===== STYLES DE DÉMONSTRATION ===== */
        .demo-content {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--secondary);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #666;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- ===== OPTION 1: MENU LATÉRAL MODERNE ===== -->
        <nav class="modern-sidebar" id="modernSidebar">
            <div class="sidebar-header">
                <a href="#" class="brand">
                    <i class='bx bxs-store-alt'></i>
                    <span>SmartStock</span>
                </a>
            </div>
            
            <div class="modern-menu">
                <div class="menu-item">
                    <a href="{{route('dashboard')}}" class="menu-link active">
                        <i class='bx bxs-dashboard menu-icon'></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('listproduit') }}" class="menu-link">
                        <i class='bx bx-package menu-icon'></i>
                        <span class="menu-text">Produits</span>
                        <span class="menu-badge">
                             @php
                                echo \App\Models\Categorie::count();
                            @endphp
                        </span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('listcategorie') }}" class="menu-link">
                        <i class='bx bx-category menu-icon'></i>
                        <span class="menu-text">Catégories</span>
                          <span class="menu-badge">
                              @php
                                echo \App\Models\Categorie::count();
                            @endphp
                        </span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('listentree') }}" class="menu-link">
                        <i class='bx bx-log-in menu-icon'></i>
                        <span class="menu-text">Entrées Stock</span>
                        <span class="menu-badge">
                              @php
                                echo \App\Models\Entree::count();
                            @endphp
                        </span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a href="{{ route('listsortie') }}" class="menu-link">
                        <i class='bx bx-receipt menu-icon'></i>
                        <span class="menu-text">Factures</span>
                          <span class="menu-badge">
                              @php
                                echo \App\Models\Sortie::count();
                            @endphp
                        </span>
                    </a>
                </div>
                
                @if(auth()->user()->role === 'super_admin')
                <div class="menu-item">
                    <a href="{{ route('listutilisateur') }}" class="menu-link">
                        <i class='bx bx-user-circle menu-icon'></i>
                        <span class="menu-text">Administration</span>
                    </a>
                </div>
                @endif
            </div>
            
            <div class="logout-section">
                <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out'></i>
                    <span>Déconnexion</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>

        <!-- ===== CONTENU PRINCIPAL ===== -->
        <div class="main-content">
            <!-- Header -->
            <header class="top-header">
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class='bx bx-menu'></i>
                </button>
                
                <h1 class="page-title" id="pageTitle">Tableau de Bord</h1>
                
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role text-muted">{{ auth()->user()->role }}</div>
                    </div>
                </div>
            </header>

            <!-- ===== OPTION 2: MENU HORIZONTAL (uniquement pour tablettes) ===== -->
            <nav class="horizontal-nav">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link active">
                            <i class='bx bxs-dashboard'></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('listproduit') }}" class="nav-link">
                            <i class='bx bx-package'></i>
                            <span>Produits</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('listcategorie') }}" class="nav-link">
                            <i class='bx bx-category'></i>
                            <span>Catégories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('listentree') }}" class="nav-link">
                            <i class='bx bx-log-in'></i>
                            <span>Entrées</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('listsortie') }}" class="nav-link">
                            <i class='bx bx-receipt'></i>
                            <span>Factures</span>
                        </a>
                    </li>
                    @if(auth()->user()->role === 'super_admin')
                    <li class="nav-item">
                        <a href="{{ route('listutilisateur') }}" class="nav-link">
                            <i class='bx bx-user-circle'></i>
                            <span>Admin</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>

            <!-- Zone de contenu -->
           
                
                <!-- Le contenu réel de l'application -->
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- ===== MENU MOBILE (pour téléphones) ===== -->
        <nav class="mobile-nav">
            <ul class="mobile-nav-items">
                <li class="mobile-nav-item">
                    <a href="{{route('dashboard')}}" class="mobile-nav-link active">
                        <i class='bx bxs-dashboard'></i>
                        <span>Accueil</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="{{ route('listproduit') }}" class="mobile-nav-link">
                        <i class='bx bx-package'></i>
                        <span>Produits</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="{{ route('listcategorie') }}" class="mobile-nav-link">
                        <i class='bx bx-category'></i>
                        <span>Catégories</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="{{ route('listentree') }}" class="mobile-nav-link">
                        <i class='bx bx-log-in'></i>
                        <span>Entrées</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="{{ route('listsortie') }}" class="mobile-nav-link">
                        <i class='bx bx-receipt'></i>
                        <span>Factures</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Overlay pour mobile -->
        <div class="mobile-overlay" id="mobileOverlay"></div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Gestion du menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const modernSidebar = document.getElementById('modernSidebar');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            // Ouvrir/fermer le menu mobile
            mobileMenuBtn.addEventListener('click', function() {
                modernSidebar.classList.toggle('active');
                mobileOverlay.style.display = modernSidebar.classList.contains('active') ? 'block' : 'none';
            });
            
            // Fermer le menu en cliquant sur l'overlay
            mobileOverlay.addEventListener('click', function() {
                modernSidebar.classList.remove('active');
                mobileOverlay.style.display = 'none';
            });
            
            // Mettre à jour les éléments actifs
            const currentPath = window.location.pathname;
            const allLinks = document.querySelectorAll('.menu-link, .nav-link, .mobile-nav-link');
            
            allLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                    
                    // Mettre à jour le titre de la page
                    const pageTitle = document.getElementById('pageTitle');
                    if (pageTitle && link.querySelector('.menu-text')) {
                        pageTitle.textContent = link.querySelector('.menu-text').textContent;
                    }
                }
                
                // Fermer le menu mobile après clic
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 1024) {
                        modernSidebar.classList.remove('active');
                        mobileOverlay.style.display = 'none';
                    }
                });
            });
            
            // Adapter le menu en fonction de la taille de l'écran
            window.addEventListener('resize', function() {
                if (window.innerWidth > 1024) {
                    modernSidebar.classList.remove('active');
                    mobileOverlay.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>