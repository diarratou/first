@extends('welcome')

@section('content')
<style>

    .table {
        width: 100%;
        background-color: #1e1e1e;
        color: #ffc107;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 16px;
        border: 1px solid #444;
    }

    .table thead {
        background-color: #ffc107;
        color: #000;
    }

    .table tbody tr:hover {
        background-color: #2a2a2a;
    }

    .badge {
        display: inline-block;
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 9999px;
        font-weight: bold;
    }

    .bg-yellow {
        background-color: #ffeb3b;
        color: #000;
    }

    .bg-blue {
        background-color: #2196f3;
        color: #fff;
    }

    .bg-green {
        background-color: #4caf50;
        color: #fff;
    }

    .bg-purple {
        background-color: #9c27b0;
        color: #fff;
    }

    .pagination {
        display: flex;
        justify-content: center;
        padding: 1rem 0;
    }

    .pagination nav {
        background-color: #1e1e1e;
    }

    .container {
        max-width: 1200px;
    }

    h1 {
        color: #ffc107;
        font-weight: bold;
        margin-bottom: 2rem;
        text-align: center;
    }
</style>

<div class="container my-5">
    <h1>📦 Liste des Commandes</h1>

    <div class="shadow rounded bg-dark p-4">
        <div class="table-responsive">
            @if(Auth::check() && Auth::user()->role === 'gestionnaire')
                <table class="table table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Statut</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                            <tr>
                                <td>{{ $commande->id }}</td>
                                <td>{{ $commande->user->name }}</td>
                                <td>
                                    <span class="badge
                                        @if($commande->statut == 'en_attente') bg-yellow
                                        @elseif($commande->statut == 'en_preparation') bg-blue
                                        @elseif($commande->statut == 'prete') bg-green
                                        @elseif($commande->statut == 'payee') bg-purple
                                        @endif">
                                        {{ $commande->statut }}
                                    </span>
                                </td>
                                <td>{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                <td>{{ $commande->date_commande }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('showCommande', $commande->id) }}" class="btn btn-sm btn-primary">Details</a>
                                        <form method="POST" action="{{ route('deleteCommande', $commande->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Annuler</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if(Auth::check() && Auth::user()->role === 'client')
                <table class="table table-dark table-bordered table-hover align-middle text-center">
                    <thead class="table-warning text-dark">
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
                        @foreach($burgers as $c)
                            <tr>
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

                                    <form method="get" action="{{ route('archiveBurger', $c->id) }}" onsubmit="return confirm('Confirmer Archive ?')">
                                        @csrf
                                        <button type="submit">Archiver</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $commandes->links() }}
        </div>
    </div>
</div>
@endsection
