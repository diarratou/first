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
                        <h1 class="text-white mb-0 fw-bold fs-3">Mon Panier</h1>
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
        @if($cartItems->isEmpty())
            <!-- Empty Cart -->
            <div class="text-center py-5">
                <div class="bg-white rounded-circle mx-auto mb-4 shadow-lg" style="width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                    <div class="bg-danger rounded-circle" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <div class="bg-white rounded-circle" style="width: 40px; height: 40px;"></div>
                    </div>
                </div>
                <h3 class="text-white mb-2">Votre panier est vide</h3>
                <p class="text-white opacity-75">Ajoutez des délicieux burgers à votre panier</p>
                <a href="{{ route('burger') }}" class="btn btn-light btn-lg rounded-pill px-5 mt-3 shadow">
                    Découvrir nos burgers
                </a>
            </div>
        @else
            <!-- Cart Items -->
            <div class="row g-4">
                @foreach($cartItems as $item)
                <div class="col-12">
                    <div class="card border-0 rounded-4 shadow-lg overflow-hidden" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        <div class="row g-0 align-items-center p-3">
                            <!-- Image -->
                            <div class="col-3 col-md-2">
                                <div class="position-relative">
                                    <img src="{{ 'storage/'.$item->burger->image }}"
                                         alt="{{ $item->burger->nom }}"
                                         class="img-fluid rounded-3 shadow-sm"
                                         style="height: 80px; width: 80px; object-fit: cover;">
                                    <div class="position-absolute top-0 start-0 bg-danger text-white rounded-pill px-2 py-1"
                                         style="font-size: 0.7rem; transform: translate(-10px, -10px);">
                                        {{ $item->quantite }}
                                    </div>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="col-6 col-md-7 ps-3">
                                <h5 class="fw-bold mb-1 text-dark">{{ $item->burger->nom }}</h5>
                                <p class="text-muted mb-2" style="font-size: 0.9rem;">
                                    {{ $item->burger->prix }} FCFA l'unité
                                </p>

                                <!-- Quantity Controls -->
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="d-flex align-items-center bg-light rounded-pill overflow-hidden">
                                        <button type="button" class="btn btn-sm text-danger px-3" onclick="decrementQuantity(this)">-</button>
                                        <input type="number" name="quantite" value="{{ $item->quantite }}"
                                               min="1" max="{{ $item->burger->stock }}"
                                               class="form-control border-0 bg-transparent text-center fw-bold"
                                               style="width: 50px;" readonly>
                                        <button type="button" class="btn btn-sm text-success px-3" onclick="incrementQuantity(this)">+</button>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 ms-2">
                                        Modifier
                                    </button>
                                </form>
                            </div>

                            <!-- Price & Remove -->
                            <div class="col-3 col-md-3 text-end">
                                <h5 class="fw-bold text-danger mb-2">
                                    {{ number_format($item->burger->prix * $item->quantite) }} FCFA
                                </h5>
                                <a href="{{ route('cart.remove', $item) }}"
                                   class="btn btn-outline-danger btn-sm rounded-pill">
                                    Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4 text-dark">Résumé de la commande</h4>

                            <!-- Summary Details -->
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Sous-total</span>
                                <span class="fw-semibold">{{ number_format($total) }} FCFA</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Frais de livraison</span>
                                <span class="fw-semibold text-success">Gratuit</span>
                            </div>
                            <hr class="my-3">
                            <div class="d-flex justify-content-between mb-4">
                                <span class="h5 fw-bold text-dark">Total</span>
                                <span class="h5 fw-bold text-danger">{{ number_format($total) }} FCFA</span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-3">
                                <a href="{{ route('cart.checkout') }}"
                                   class="btn btn-danger btn-lg rounded-pill fw-bold py-3 shadow">
                                    Valider la commande
                                </a>
                                <a href="{{ route('burger') }}"
                                   class="btn btn-outline-danger btn-lg rounded-pill fw-bold">
                                    Continuer mes achats
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Info -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
                        <div class="card-body p-4 text-center">
                            <div class="bg-danger rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <div class="bg-white rounded" style="width: 25px; height: 25px;"></div>
                            </div>
                            <h6 class="fw-bold text-dark mb-2">Livraison en 40 minutes</h6>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                Si vous n'êtes pas satisfait de votre commande dans les 40 minutes,
                                votre repas sera gratuit ou nous vous rembourserons.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function incrementQuantity(button) {
    const input = button.parentElement.querySelector('input[name="quantite"]');
    const max = parseInt(input.getAttribute('max'));
    const current = parseInt(input.value);
    if (current < max) {
        input.value = current + 1;
    }
}

function decrementQuantity(button) {
    const input = button.parentElement.querySelector('input[name="quantite"]');
    const current = parseInt(input.value);
    if (current > 1) {
        input.value = current - 1;
    }
}
</script>

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
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.btn {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-danger {
    background: linear-gradient(135deg, #ff4757, #ff3838);
    border: none;
}

.btn-danger:hover {
    background: linear-gradient(135deg, #ff3838, #c44569);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 71, 87, 0.3);
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

.bg-danger {
    background: linear-gradient(135deg, #ff4757, #ff3838) !important;
}

.text-danger {
    color: #ff4757 !important;
}

.rounded-4 {
    border-radius: 1.5rem !important;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}
</style>
@endsection
