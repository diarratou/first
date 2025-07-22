@extends('welcome')

@section('content')
<div class="container py-5" style="background: linear-gradient(135deg, #000000, #1a1a1a); min-height: 100vh; color: #f1c40f;">
    <h1 class="text-center mb-5 display-5 fw-bold text-warning">🛒 Votre Panier</h1>

    @if($cartItems->isEmpty())
        <p class="text-center fs-4 text-warning">Votre panier est vide. Ajoutez des burgers ! 🍔</p>
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

        <div class="text-end mt-5">
            <h3 class="text-warning fw-bold">Total : {{ $total }} FCFA</h3>
            <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg fw-bold mt-3">✅ Passer la commande</a>
        </div>
    @endif
</div>
@endsection
