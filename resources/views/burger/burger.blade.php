@extends('welcome')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .app-container {
        background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
        min-height: 100vh;
        padding: 20px 0;
    }

    .header-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        margin: 0 15px 25px 15px;
        padding: 25px;
        box-shadow: 0 8px 32px rgba(255, 65, 108, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 0;
    }

    .btn-add-new {
        background: linear-gradient(135deg, #ff416c, #ff4757);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
    }

    .btn-add-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 65, 108, 0.6);
        color: white;
    }

    .search-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        margin: 0 15px 25px 15px;
        padding: 20px;
        box-shadow: 0 8px 32px rgba(255, 65, 108, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .search-input {
        background: rgba(248, 249, 250, 0.8);
        border: 2px solid rgba(255, 65, 108, 0.1);
        border-radius: 16px;
        padding: 14px 18px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        color: #2d3436;
    }

    .search-input:focus {
        border-color: #ff416c;
        box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.1);
        background: white;
    }

    .search-input::placeholder {
        color: #636e72;
        font-weight: 500;
    }

    .btn-search {
        background: linear-gradient(135deg, #ff416c, #ff4757);
        color: white;
        border: none;
        border-radius: 16px;
        padding: 14px 20px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
    }

    .btn-search:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 65, 108, 0.5);
    }

    .burger-grid {
        padding: 0 15px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 16px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .burger-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(255, 65, 108, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        height: fit-content;
    }

    .burger-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(255, 65, 108, 0.2);
    }

    .burger-image {
        height: 160px;
        width: 100%;
        object-fit: cover;
    }

    .burger-info {
        padding: 16px;
    }

    .burger-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 6px;
    }

    .burger-price {
        font-size: 1rem;
        font-weight: 700;
        color: #ff416c;
        margin-bottom: 6px;
    }

    .stock-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .stock-available {
        background: rgba(0, 184, 148, 0.1);
        color: #00b894;
    }

    .stock-unavailable {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
    }

    .burger-description {
        color: #636e72;
        font-size: 0.85rem;
        line-height: 1.4;
        margin-bottom: 15px;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .btn-action {
        background: rgba(255, 65, 108, 0.1);
        color: #ff416c;
        border: 1px solid rgba(255, 65, 108, 0.2);
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        background: #ff416c;
        color: white;
        transform: translateY(-1px);
    }

    .btn-danger {
        background: rgba(231, 76, 60, 0.1);
        color: #e74c3c;
        border-color: rgba(231, 76, 60, 0.2);
    }

    .btn-danger:hover {
        background: #e74c3c;
        color: white;
    }

    .cart-section {
        background: rgba(255, 255, 255, 0.5);
        border-radius: 12px;
        padding: 12px;
    }

    .quantity-input {
        background: rgba(248, 249, 250, 0.8);
        border: 2px solid rgba(255, 65, 108, 0.1);
        border-radius: 12px;
        padding: 10px;
        text-align: center;
        font-weight: 600;
        color: #2d3436;
        width: 70px;
    }

    .quantity-input:focus {
        border-color: #ff416c;
        box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.1);
    }

    .btn-add-cart {
        background: linear-gradient(135deg, #ff416c, #ff4757);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 16px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        flex: 1;
        box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
    }

    .btn-add-cart:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 65, 108, 0.5);
    }

    .btn-disabled {
        background: #ddd;
        color: #999;
        border: none;
        border-radius: 12px;
        padding: 10px 16px;
        font-weight: 600;
        cursor: not-allowed;
        width: 100%;
    }

    .alert {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 16px 20px;
        margin: 0 15px 20px 15px;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .alert-success {
        border-left: 4px solid #00b894;
        color: #00b894;
    }

    .alert-danger {
        border-left: 4px solid #e74c3c;
        color: #e74c3c;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        padding: 30px 15px;
    }

    .pagination {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 8px;
        box-shadow: 0 8px 32px rgba(255, 65, 108, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .page-link {
        color: #ff416c;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        padding: 10px 16px;
        transition: all 0.3s ease;
    }

    .page-link:hover, .active .page-link {
        background: linear-gradient(135deg, #ff416c, #ff4757);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
    }

    @media (max-width: 768px) {
        .burger-grid {
            grid-template-columns: 1fr;
            padding: 0 10px;
        }

        .header-section, .search-section {
            margin: 0 10px 20px 10px;
            padding: 20px;
        }

        .header-title {
            font-size: 1.5rem;
        }

        .action-buttons {
            justify-content: center;
        }
    }
</style>

<div class="app-container">
    @if(Auth::check() && Auth::user()->role === 'gestionnaire')
    <div class="header-section">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="header-title">
                Gestion des Burgers
            </h1>
            <a href="{{ route('addBurger') }}" class="btn-add-new">
                Nouveau Burger
            </a>
        </div>
    </div>
    @endif

    @if(session("message"))
        <div class="alert alert-success">
            <strong>Succès!</strong> {{ session("message") }}
        </div>
    @endif

    @if(session("messageDelete"))
        <div class="alert alert-danger">
            <strong>Supprimé!</strong> {{ session("messageDelete") }}
        </div>
    @endif

    @if(Auth::check() && Auth::user()->role === 'client')
    <div class="search-section">
        <form method="GET" action="{{ route('burger') }}" class="row g-3">
            <div class="col-md-5">
                <input type="text" name="nom" class="form-control search-input" placeholder="Rechercher un burger..." value="{{ request('nom') }}">
            </div>
            <div class="col-md-4">
                <input type="number" name="prix" class="form-control search-input" placeholder="Prix maximum" value="{{ request('prix') }}">
            </div>
            <div class="col-md-3">
                <button class="btn-search w-100">Rechercher</button>
            </div>
        </form>
    </div>
    @endif

    <div class="burger-grid">
        @foreach ($burgers as $burger)
        <div class="burger-card">
            <img src="{{ asset('storage/'.$burger->image) }}" alt="{{ $burger->nom }}" class="burger-image">

            <div class="burger-info">
                <h5 class="burger-name">
                    {{ $burger->nom }}
                </h5>

                <div class="burger-price">
                    {{ number_format($burger->prix, 0, ',', ' ') }} FCFA
                </div>

                <span class="stock-status {{ $burger->stock > 0 ? 'stock-available' : 'stock-unavailable' }}">
                    @if($burger->stock > 0)
                        En stock ({{ $burger->stock }})
                    @else
                        Rupture de stock
                    @endif
                </span>

                <p class="burger-description">
                    {{ Str::limit($burger->description, 80) }}
                </p>

                @if(Auth::check() && Auth::user()->role === 'gestionnaire')
                    <div class="action-buttons">
                        <a href="{{ route('editBurger', $burger->id) }}" class="btn-action">
                            Modifier
                        </a>

                        <form action="{{ route('deleteBurger', $burger->id) }}" method="post" style="display: inline;" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf @method("delete")
                            <button type="submit" class="btn-action btn-danger">
                                Supprimer
                            </button>
                        </form>

                        @if(!$burger->archive)
                            <form action="{{ route('burgers.archiver', $burger->id) }}" method="POST" style="display: inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-action">
                                    Archiver
                                </button>
                            </form>
                        @else
                            <form action="{{ route('burgers.desarchiver', $burger->id) }}" method="POST" style="display: inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-action">
                                    Désarchiver
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

                @if(Auth::check() && Auth::user()->role === 'client')
                    <div class="cart-section">
                        @if($burger->stock > 0)
                        <form action="{{ route('burger.addToCart', $burger) }}" method="POST" class="d-flex align-items-center gap-3">
                            @csrf
                            <input type="number" name="quantite" value="1" min="1" max="{{ $burger->stock }}" class="quantity-input">
                            <button type="submit" class="btn-add-cart">
                                Choisir Emplacement
                            </button>
                        </form>
                        @else
                        <button class="btn-disabled" disabled>
                            Rupture de stock
                        </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-container">
        {{ $burgers->links() }}
    </div>
</div>
@endsection
