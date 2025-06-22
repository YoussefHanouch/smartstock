<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Title</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <head>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="{{ url ('menuTemp/css/style.css')}}">
        <title>GestionStock</title>
    </head>
    <style>
        /* Basic styling for the side menu */
.side-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.side-menu .nav-item {
    position: relative;
}

.side-menu .nav-link {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #000; /* Default text color */
    transition: background-color 0.3s ease;
}

/* Hover effect */
.side-menu .nav-link:hover {
    background-color: #3b82f6; /* Background color on hover */
    color: #fff; /* Change text color on hover */
}

        /* Basic styling for the side menu */
        .side-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .side-menu .nav-item {
            position: relative;
        }

        .side-menu .nav-link {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #000; /* Default text color */
            transition: background-color 0.3s ease;
        }

        /* Hover effect */
        .side-menu .nav-link:hover {
            background-color: #3b82f6; /* Background color on hover */
            color: #000; /* Change text color on hover */
        }
    </style>

    <body>
    
        <!-- Sidebar -->
        <div class="sidebar ">
            <a href="#" class="logo">
                &nbsp; &nbsp; &nbsp; <div class="logo-name"><span>NajiMatique</span></div>
            </a>
            <ul class="side-menu">
                <li class="nav-item ">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class='bx bxs-dashboard'></i>Dashboard
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('listproduit') }}" class="nav-link">
                        <i class='bx bx-store-alt'></i>Produit
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('listcategorie') }}" class="nav-link">
                        <i class='bx bx-analyse'></i>Catégorie
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('listentree') }}" class="nav-link">
                        <i class='bx bx-message-square-dots'></i>Liste des entrées
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ route('listsortie') }}" class="nav-link">
                        <i class='bx bx-group'></i>Les Factures
                    </a>
                </li>
                @if(auth()->user()->role === 'super_admin')

                <li class="nav-item ">
                    <a href="{{ route('listutilisateur') }}" class="nav-link">
                        <i class='bx bx-group'></i>Gestion des admin
                    </a>
                </li>
                @endif
          
            
          
                <li>
                    <a  href="{{ route('logout') }}" class="logout" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                         &nbsp;&nbsp;  <i class='bx bx-log-out-circle'></i>
                       Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <!-- End of Sidebar -->
    
        <!-- Main Content -->
        <div class="content">
            <!-- Navbar -->
            <nav>
              
                
                <!-- <input type="checkbox" id="theme-toggle" hidden>
                <label for="theme-toggle" class="theme-toggle"></label>
                <a href="#" class="notif">
                    <i class='bx bx-bell'></i>
                    <span class="count">12</span>
                </a>
                <a href="#" class="profile">
                    <img src="images/logo.png">
                </a> -->
            </nav>
    
            <!-- End of Navbar -->
            <main class="py-4">
                @yield('content')
            </main>
    
        </div>
    
    </body>
</body>
<script src="{{url('menuTemp/js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Your additional JavaScript files -->
<script src="{{ asset('js/custom.js') }}"></script> 
</html>