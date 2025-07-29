@extends('welcome')

@section('content')

<style>


    .table-dark {
        background-color: #1e1e1e;
        color: #ffc107;
    }

    .table-warning th {
        background-color: #ffc107;
        color: #000;
    }

    .card {
        background-color: #1e1e1e;
        color: #ffc107;
        border: 1px solid #ffc107;
    }

    .card img {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        object-fit: cover;
        height: 200px;
    }

    .btn-details {
        background-color: #17a2b8;
        color: white;
        font-weight: bold;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
    }

    .btn-commande {
        background-color: #ffc107;
        color: #000;
        font-weight: bold;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
    }

    .btn-commande:hover, .btn-details:hover {
        opacity: 0.9;
    }

    .btn-outline-warning, .btn-outline-danger, .btn-outline-success {
        font-weight: bold;
    }

    .search-form input {
        border-radius: 5px;
    }

    .search-form button {
        font-weight: bold;
    }
</style>

<div class="container my-4">

    @if(Auth::check() && Auth::user()->role === 'gestionnaire')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-warning">Liste des Burgers</h2>
        <a href="{{ route('addBurger') }}" class="btn btn-warning fw-bold text-dark">➕ Ajouter un Burger</a>
    </div>
    @endif

    @if(session("message"))
        <div class="alert alert-success">{{ session("message") }}</div>
    @endif

    @if(session("messageDelete"))
        <div class="alert alert-danger">{{ session("messageDelete") }}</div>
    @endif

    <div class="table-responsive">
        @if(Auth::check() && Auth::user()->role === 'gestionnaire')
            <table class="table table-dark table-bordered table-hover align-middle text-center">
                <thead class="table-warning text-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($burgers as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td class="fw-bold text-warning">{{ $c->nom }}</td>
                            <td>{{ number_format($c->prix, 0, ',', ' ') }} FCFA</td>
                            <td>
                                <img src="{{ asset('storage/'.$c->image) }}" alt="Image" width="70" height="70" class="rounded">
                            </td>
                            <td>{{ Str::limit($c->description, 40) }}</td>
                            <td>{{ $c->stock }}</td>
                            <td class="d-flex justify-content-around">
                                <form action="{{ route('deleteBurger', $c->id) }}" method="post" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @method("delete")
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">🗑️</button>
                                </form>
                                <a href="{{ route('editBurger', $c->id) }}" class="btn btn-outline-warning btn-sm">✏️</a>

                                @if(!$c->archive)
                                    <form action="{{ route('burgers.archiver', $c->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm">🗃 Archiver</button>
                                    </form>
                                @else
                                    <form action="{{ route('burgers.desarchiver', $c->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-success btn-sm">♻ Desarchiver</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {{-- Recherche pour client --}}
    @if(Auth::check() && Auth::user()->role === 'client')
    <div class="container my-4">
        <form method="GET" action="{{ route('burger') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="nom" class="form-control" placeholder="Recherche par nom..." value="{{ request('nom') }}">
        </div>
        <div class="col-md-3">
            <input type="number" name="prix" class="form-control" placeholder="Prix" value="{{ request('prix') }}">
        </div>

        <div class="col-md-2">
            <button class="btn btn-warning w-100">🔍 Filtrer</button>
        </div>
    </form>
    </div>
    @endif

    {{-- Cartes pour client et visiteur --}}
    @if((Auth::check() && Auth::user()->role === 'client') || !Auth::check())
        <div class="row">
            @foreach ($burgers as $burger)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/'.$burger->image) }}" alt="{{ $burger->nom }}" class="w-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $burger->nom }}</h5>
                            <p class="card-text">{{ number_format($burger->prix, 0, ',', ' ') }} FCFA</p>
                            <p class="{{ $burger->stock > 0 ? 'text-success' : 'text-danger' }}">
                                {{ $burger->stock > 0 ? 'En stock (' . $burger->stock . ')' : 'Rupture de stock' }}
                            </p>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('showBurger', $burger->id) }}">
                                    <button class="btn-details">Détails</button>
                                </a>
                                @if(Auth::check() && Auth::user()->role === 'client' && $burger->stock > 0)
                                    @if($burger->stock > 0)
                                <form action="{{ route('burger.addToCart', $burger) }}" method="POST" class="flex items-center gap-3">
                                    @csrf
                                    <input type="number" name="quantite" value="1" min="1" max="{{ $burger->stock }}" class="bg-black text-warning border border-warning rounded text-center focus:ring-yellow-400 transition-all" style="max-width: 70px; height: 39px; font-weight: bold;">
                                    <button type="submit" class="flex-1 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all btn-commande">
                                        Commander
                                    </button>
                                </form>
                            @else
                                <span class="py-2 text-center block bg-red-600 text-white rounded-lg opacity-75 cursor-not-allowed">
                                    Rupture de Stock
                                </span>
                            @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $burgers->links() }}
    </div>

</div>
@endsection
