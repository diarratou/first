{{-- @extends('welcome')

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
                    @foreach($burger1 as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td class="fw-bold text-warning">{{ $c->nom }}</td>
                            <td>{{ number_format($c->prix, 0, ',', ' ') }} FCFA</td>
                            <td>
                                <img src="{{ asset('images/'.$c->image) }}" alt="Image" width="70" height="70" class="rounded">
                            </td>
                            <td>{{ Str::limit($c->description, 40) }}</td>
                            <td>{{ $c->stock }}</td>
                            <td class="d-flex justify-content-around">
                                <a href="desarchiveBurger" class="btn btn-outline-success btn-sm">📦 Desarchiver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>





    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $burgers->links() }}
    </div>

</div>
@endsection --}}

@extends('welcome') {{-- ou welcome si c’est ta base --}}

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-warning">🗃 Burgers Archivés</h2>

    @if($burgers->isEmpty())
        <div class="alert alert-info">Aucun burger archivé.</div>
    @else
        <table class="table table-bordered table-dark text-warning">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($burgers as $burger)
                    <tr>
                        <td>{{ $burger->nom }}</td>
                        <td>{{ number_format($burger->prix, 0, ',', ' ') }} FCFA</td>
                        <td>
                            <img src="{{ asset('storage/'.$burger->image) }}" alt="Image" width="70" height="70" class="rounded">
                        </td>
                        <td>{{ Str::limit($burger->description, 40) }}</td>
                        <td>{{ $burger->stock }}</td>
                        <td>
                            <form action="{{ route('burgers.desarchiver', $burger->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">♻ Desarchiver</button>
                            </form>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
    <div class="text-center">
            <a href="{{ route('burger') }}" class="btn-back">⬅️ Retour à la liste</a>
        </div>
</div>
@endsection
