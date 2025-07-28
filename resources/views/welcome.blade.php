<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IPP BURGER</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background-color: #000000;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffc107 !important;
        }

        .navbar-custom .nav-link:hover {
            color: #ffffff !important;
        }

        .navbar-custom .navbar-toggler {
            background-color: #ffc107;
        }

        .logout-btn, .login-btn {
            background-color: #ffc107;
            color: #000;
            border: 2px solid #ffc107;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        .logout-btn:hover, .login-btn:hover {
            background-color: #000;
            color: #ffc107;
            border: 2px solid #ffc107;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">IPP BURGER</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('burger') }}">Liste des Burgers</a>
                </li>
                @if(Auth::check() && Auth::user()->role === 'gestionnaire')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('commande') }}">Gestion des Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('commande') }}">Statistiques</a>
                    </li>
                @endif
                @if(Auth::check() && Auth::user()->role === 'client')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.show') }}">Commandes</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('facture') }}">Facture</a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav">
                @if(!Auth::check())
                    <li class="nav-item">
                        <form method="GET" action="{{ route('login') }}">
                            @csrf
                            <button type="submit" class="login-btn">
                                {{ __('Connexion') }}
                            </button>
                        </form>
                    </li>
                @endif
                <li class="nav-item ms-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            {{ __('Deconnexion') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
