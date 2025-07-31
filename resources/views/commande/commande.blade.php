@extends('welcome')

@section('content')
<div class="min-vh-100" style="background: linear-gradient(135deg, #ff4757 0%, #ff3838 50%, #c44569 100%);">
    <!-- Header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle p-2 me-3 shadow-sm">
                            <div class="bg-danger rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                <div class="bg-white rounded-circle" style="width: 20px; height: 20px;"></div>
                            </div>
                        </div>
                        <h1 class="text-white mb-0 fw-bold fs-3">
                            @if(Auth::check() && Auth::user()->role === 'gestionnaire')
                                Gestion des Commandes
                            @else
                                Mes Commandes
                            @endif
                        </h1>
                    </div>
                    <a href="{{ route('burger') }}" class="btn btn-light rounded-pill px-4 shadow-sm">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container pb-5">
        @if(Auth::check() && Auth::user()->role === 'gestionnaire')
            <!-- Gestionnaire View -->
            <div class="card border-0 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-header bg-transparent border-0 p-4">
                    <h4 class="fw-bold text-dark mb-0">Toutes les commandes</h4>
                    <p class="text-muted mb-0">Gérez et suivez l'état des commandes</p>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #ff4757, #ff3838);">
                                <tr class="text-white">
                                    <th class="border-0 py-4 px-4 fw-bold">ID</th>
                                    <th class="border-0 py-4 fw-bold">Utilisateur</th>
                                    <th class="border-0 py-4 fw-bold">Statut</th>
                                    <th class="border-0 py-4 fw-bold">Total</th>
                                    <th class="border-0 py-4 fw-bold">Date</th>
                                    <th class="border-0 py-4 fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commandes as $commande)
                                    <tr class="border-0">
                                        <td class="py-4 px-4 fw-bold text-danger">#{{ $commande->id }}</td>
                                        <td class="py-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-danger rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                    <span class="text-white fw-bold" style="font-size: 0.8rem;">{{ substr($commande->user->name, 0, 1) }}</span>
                                                </div>
                                                <span class="fw-semibold">{{ $commande->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <span class="badge rounded-pill px-3 py-2 fw-bold
                                                @if($commande->statut == 'en_attente') bg-warning text-dark
                                                @elseif($commande->statut == 'en_preparation') bg-info text-white
                                                @elseif($commande->statut == 'prete') bg-success text-white
                                                @elseif($commande->statut == 'payee') bg-primary text-white
                                                @endif">
                                                @if($commande->statut == 'en_attente') En attente
                                                @elseif($commande->statut == 'en_preparation') En préparation
                                                @elseif($commande->statut == 'prete') Prête
                                                @elseif($commande->statut == 'payee') Payée
                                                @endif
                                            </span>
                                        </td>
                                        <td class="py-4 fw-bold text-dark">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                        <td class="py-4 text-muted">{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y H:i') }}</td>
                                        <td class="py-4 text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('showCommande', $commande->id) }}"
                                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    Détails
                                                </a>
                                                <form method="POST" action="{{ route('deleteCommande', $commande->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?')">
                                                        Annuler
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @elseif(Auth::check() && Auth::user()->role === 'client')
            <!-- Client View - Burger Management -->
            <div class="card border-0 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-header bg-transparent border-0 p-4">
                    <h4 class="fw-bold text-dark mb-0">Gestion des Burgers</h4>
                    <p class="text-muted mb-0">Gérez votre catalogue de burgers</p>
                </div>
                <div class="card-body p-0">
                    <div class="row g-4 p-4">
                        @foreach($burgers as $burger)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden" style="transition: all 0.3s ease;">
                                    <!-- Image -->
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/'.$burger->image) }}"
                                             alt="{{ $burger->nom }}"
                                             class="w-100"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-success rounded-pill px-2 py-1">
                                                Stock: {{ $burger->stock }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="card-body p-3">
                                        <h5 class="fw-bold text-dark mb-2">{{ $burger->nom }}</h5>
                                        <p class="text-muted small mb-2">{{ Str::limit($burger->description, 60) }}</p>
                                        <p class="h6 fw-bold text-danger mb-3">{{ number_format($burger->prix, 0, ',', ' ') }} FCFA</p>

                                        <!-- Actions -->
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('editBurger', $burger->id) }}"
                                               class="btn btn-sm btn-outline-danger rounded-pill flex-fill">
                                                Modifier
                                            </a>
                                            <form action="{{ route('deleteBurger', $burger->id) }}"
                                                  method="post"
                                                  class="flex-fill"
                                                  onsubmit="return confirm('Confirmer la suppression ?')">
                                                @method("delete")
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill w-100">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Archive Button -->
                                        <form method="get"
                                              action="{{ route('archiveBurger', $burger->id) }}"
                                              class="mt-2"
                                              onsubmit="return confirm('Confirmer Archive ?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-warning rounded-pill w-100">
                                                Archiver
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if(isset($commandes))
        <div class="d-flex justify-content-center mt-4">
            <div class="bg-white rounded-4 shadow-sm p-2">
                {{ $commandes->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

body {
    font-family: 'Inter', sans-serif;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.table {
    border-collapse: separate;
    border-spacing: 0;
}

.table tbody tr {
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.table tbody tr:hover {
    background-color: rgba(255, 71, 87, 0.02);
}

.btn {
    transition: all 0.3s ease;
}

.btn-outline-danger {
    border-color: #ff4757;
    color: #ff4757;
}

.btn-outline-danger:hover {
    background-color: #ff4757;
    border-color: #ff4757;
    transform: translateY(-1px);
}

.rounded-4 {
    border-radius: 1.5rem !important;
}

.pagination .page-link {
    border: none;
    color: #ff4757;
    padding: 0.5rem 0.75rem;
    margin: 0 0.125rem;
    border-radius: 0.5rem;
}

.pagination .page-item.active .page-link {
    background-color: #ff4757;
    border-color: #ff4757;
}

.pagination .page-link:hover {
    background-color: rgba(255, 71, 87, 0.1);
    color: #ff4757;
}
</style>
@endsection
