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
                        <h1 class="text-white mb-0 fw-bold fs-3">Commande #{{ $commande->id }}</h1>
                    </div>
                    <a href="{{ route('commande') }}" class="btn btn-light rounded-pill px-4 shadow-sm">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container pb-5">
        <div class="row g-4">
            <!-- Order Details Card -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <div class="card-header bg-transparent border-0 p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="fw-bold text-dark mb-1">Détails de la commande</h4>
                                <p class="text-muted mb-0">Informations complètes</p>
                            </div>
                            <div class="text-end">
                                <span class="badge rounded-pill px-3 py-2 fw-bold fs-6
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
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- User Info -->
                            <div class="col-12 col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <div class="bg-danger rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="text-white fw-bold">{{ substr($commande->user->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">Client</h6>
                                        <p class="text-muted mb-0">{{ $commande->user->name }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Info -->
                            <div class="col-12 col-md-6">
                                <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                    <div class="bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="text-white fw-bold">📅</span>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-1">Date de commande</h6>
                                        <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y à H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Amount -->
                        <div class="mt-4 p-4 bg-light rounded-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Montant total</h6>
                                    <p class="text-muted mb-0">Montant à payer</p>
                                </div>
                                <div class="text-end">
                                    <h3 class="fw-bold text-danger mb-0">{{ number_format($commande->total) }} FCFA</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Update Card -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <div class="card-header bg-transparent border-0 p-4">
                        <h5 class="fw-bold text-dark mb-1">Mise à jour du statut</h5>
                        <p class="text-muted mb-0 small">Modifier l'état de la commande</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('updateCommande', $commande->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="statut" class="form-label fw-semibold text-dark">Nouveau statut</label>
                                <select name="statut" id="statut" class="form-select border-2 rounded-3 p-3">
                                    <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>
                                        En attente
                                    </option>
                                    <option value="en_preparation" {{ $commande->statut == 'en_preparation' ? 'selected' : '' }}>
                                        En préparation
                                    </option>
                                    <option value="prete" {{ $commande->statut == 'prete' ? 'selected' : '' }}>
                                        Prête
                                    </option>
                                    <option value="payee" {{ $commande->statut == 'payee' ? 'selected' : '' }}>
                                        Payée
                                    </option>
                                </select>
                            </div>

                            <div id="montant_paye_section" class="mb-4" style="display: none;">
                                <label for="montant_paye" class="form-label fw-semibold text-dark">Montant payé</label>
                                <div class="input-group">
                                    <input type="number" name="montant_paye" id="montant_paye"
                                           class="form-control border-2 rounded-start-3 p-3"
                                           step="0.01" placeholder="0.00">
                                    <span class="input-group-text bg-light border-2 rounded-end-3">FCFA</span>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger btn-lg rounded-pill fw-bold py-3 shadow">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Section for Ready Orders -->
                @if($commande->statut === 'prete')
                <div class="card border-0 rounded-4 shadow-lg mt-4" style="background: rgba(40, 167, 69, 0.1); backdrop-filter: blur(10px); border: 2px solid rgba(40, 167, 69, 0.2) !important;">
                    <div class="card-header bg-transparent border-0 p-4">
                        <h5 class="fw-bold text-success mb-1">Paiement en espèces</h5>
                        <p class="text-muted mb-0 small">Enregistrer le paiement reçu</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('commandes.payer.gestionnaire', $commande->id) }}">
                            @csrf
                            <div class="mb-4">
                                <label for="montant" class="form-label fw-semibold text-dark">Montant reçu</label>
                                <div class="input-group">
                                    <input type="number" name="montant" id="montant"
                                           class="form-control border-2 rounded-start-3 p-3"
                                           required placeholder="{{ $commande->total }}">
                                    <span class="input-group-text bg-light border-2 rounded-end-3">FCFA</span>
                                </div>
                                <small class="text-muted mt-1">Total à encaisser: {{ number_format($commande->total) }} FCFA</small>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold py-3 shadow">
                                    Confirmer le paiement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Order Timeline -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 rounded-4 shadow-lg" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                    <div class="card-header bg-transparent border-0 p-4">
                        <h5 class="fw-bold text-dark mb-1">Suivi de la commande</h5>
                        <p class="text-muted mb-0">Progression de votre commande</p>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Step 1: En attente -->
                            <div class="col-3 text-center">
                                <div class="position-relative mb-3">
                                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center
                                        {{ in_array($commande->statut, ['en_attente', 'en_preparation', 'prete', 'payee']) ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                        style="width: 60px; height: 60px;">
                                        <span class="fw-bold">1</span>
                                    </div>
                                    @if($commande->statut !== 'en_attente')
                                    <div class="position-absolute top-50 start-100 translate-middle-y" style="width: 100%; height: 3px; background: linear-gradient(to right, #28a745, #28a745); z-index: -1;"></div>
                                    @endif
                                </div>
                                <h6 class="fw-semibold {{ $commande->statut === 'en_attente' ? 'text-success' : 'text-muted' }}">En attente</h6>
                                <small class="text-muted">Commande reçue</small>
                            </div>

                            <!-- Step 2: En préparation -->
                            <div class="col-3 text-center">
                                <div class="position-relative mb-3">
                                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center
                                        {{ in_array($commande->statut, ['en_preparation', 'prete', 'payee']) ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                        style="width: 60px; height: 60px;">
                                        <span class="fw-bold">2</span>
                                    </div>
                                    @if(in_array($commande->statut, ['prete', 'payee']))
                                    <div class="position-absolute top-50 start-100 translate-middle-y" style="width: 100%; height: 3px; background: linear-gradient(to right, #28a745, #28a745); z-index: -1;"></div>
                                    @endif
                                </div>
                                <h6 class="fw-semibold {{ $commande->statut === 'en_preparation' ? 'text-success' : 'text-muted' }}">En préparation</h6>
                                <small class="text-muted">Cuisine en cours</small>
                            </div>

                            <!-- Step 3: Prête -->
                            <div class="col-3 text-center">
                                <div class="position-relative mb-3">
                                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center
                                        {{ in_array($commande->statut, ['prete', 'payee']) ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                        style="width: 60px; height: 60px;">
                                        <span class="fw-bold">3</span>
                                    </div>
                                    @if($commande->statut === 'payee')
                                    <div class="position-absolute top-50 start-100 translate-middle-y" style="width: 100%; height: 3px; background: linear-gradient(to right, #28a745, #28a745); z-index: -1;"></div>
                                    @endif
                                </div>
                                <h6 class="fw-semibold {{ $commande->statut === 'prete' ? 'text-success' : 'text-muted' }}">Prête</h6>
                                <small class="text-muted">Prêt à livrer</small>
                            </div>

                            <!-- Step 4: Payée -->
                            <div class="col-3 text-center">
                                <div class="position-relative mb-3">
                                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center
                                        {{ $commande->statut === 'payee' ? 'bg-success text-white' : 'bg-light text-muted' }}"
                                        style="width: 60px; height: 60px;">
                                        <span class="fw-bold">4</span>
                                    </div>
                                </div>
                                <h6 class="fw-semibold {{ $commande->statut === 'payee' ? 'text-success' : 'text-muted' }}">Payée</h6>
                                <small class="text-muted">Transaction terminée</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const statutSelect = document.getElementById('statut');
    const montantSection = document.getElementById('montant_paye_section');

    function toggleMontantSection() {
        montantSection.style.display = (statutSelect.value === 'payee') ? 'block' : 'none';
    }

    statutSelect.addEventListener('change', toggleMontantSection);
    document.addEventListener('DOMContentLoaded', toggleMontantSection);
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
}

.btn {
    transition: all 0.3s ease;
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

.btn-success {
    background: linear-gradient(135deg, #2ed573, #1e90ff);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #26de81, #1e90ff);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(46, 213, 115, 0.3);
}

.form-control:focus, .form-select:focus {
    border-color: #ff4757;
    box-shadow: 0 0 0 0.25rem rgba(255, 71, 87, 0.25);
}

.rounded-4 {
    border-radius: 1.5rem !important;
}

.input-group-text {
    border-left: none;
}

.form-control {
    border-right: none;
}

.form-control:focus {
    border-right: none;
}

.form-control:focus + .input-group-text {
    border-color: #ff4757;
}

/* Timeline Styles */
.position-relative::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 100%;
    width: 100%;
    height: 3px;
    background-color: #e9ecef;
    z-index: -1;
    transform: translateY(-50%);
}

.position-relative:last-child::before {
    display: none;
}
</style>
@endsection
