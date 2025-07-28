@extends('welcome')

@section('content')
<div class="container py-5" style="background: linear-gradient(135deg, #000000, #1a1a1a); min-height: 100vh; color: #f1c40f;">
    <h1 class="text-center mb-5 display-5 fw-bold text-warning">🛒 Vos Commandes</h1>

    @if($cartItems->isEmpty())
        <p class="text-center fs-4 text-warning">Pas de commande ! 🍔</p>
    @else
        @foreach($cartItems as $item)
            <div class="card mb-4 shadow border border-warning bg-dark text-warning">
                <div class="row g-0 align-items-center">
                    <div class="col-md-2 text-center">
                        <img src="{{ 'storage/'.$item->burger->image }}" alt="{{ $item->burger->nom }}" class="img-fluid rounded-start border border-warning p-1" style="height: 100px; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title text-warning">{{ $item->burger->nom }}</h5>
                            <p class="card-text">Prix unitaire : <strong>{{ $item->burger->prix }} FCFA</strong></p>
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <label class="me-1 fw-bold text-warning">Quantité</label>
                                <input type="number" name="quantite" value="{{ $item->quantite }}" min="1" max="{{ $item->burger->stock }}"
                                    class="form-control form-control-sm bg-black text-warning border-warning text-center" style="width: 80px;">
                                <button type="submit" class="btn btn-warning btn-sm fw-bold">🔄 Modifier</button>
                                <a href="{{ route('cart.remove', $item) }}" class="btn btn-danger btn-sm fw-bold">❌ Supprimer</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 text-end pe-4">
                        <h5 class="fw-bold">{{ $item->burger->prix * $item->quantite }} FCFA</h5>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-5 text-end">
            <div class="mb-3">
                <h3 class="text-warning fw-bold">Total : {{ $total }} FCFA</h3>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                <a href="{{ route('burger') }}" class="btn btn-outline-warning btn-lg fw-bold">↩️ Retour</a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg fw-bold">✅ Valider la commande</a>
            </div>
        </div>
        {{-- <form method="POST" action="{{ route('paiement.store', $commande->id) }}">
            @csrf

            <div class="form-group">
                <label>Montant à payer (Total : {{ $commande->total }} FCFA)</label>
                <input type="number" name="montant" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Payer</button>
        </form> --}}
        

        @if($commande->statut === 'payee')
            <div class="alert alert-info">

                Cette commande a été payée le {{ $commande->date_paiement->format('d/m/Y à H:i') }}.
            </div>
        @endif




    @endif
</div>
@endsection
