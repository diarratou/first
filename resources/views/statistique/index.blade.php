@extends('welcome')

@section('content')
<div class="container py-5" style="background: linear-gradient(135deg, #000000, #1a1a1a); min-height: 100vh;">
    <h1 class="text-center mb-5 display-5 fw-bold text-warning">📊 Statistiques IPP BURGER</h1>

    <div class="row g-4 mb-4">
        <!-- Commandes en cours -->
        <div class="col-md-4">
            <div class="card bg-dark text-warning shadow border border-warning h-100">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">📦 Commandes en cours</h5>
                    <p class="display-6 fw-bold">{{ $commandesEnCours->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Commandes validées -->
        <div class="col-md-4">
            <div class="card bg-dark text-warning shadow border border-success h-100">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">✅ Commandes validées</h5>
                    <p class="display-6 fw-bold">{{ $commandesValidees->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Recette journalière -->
        <div class="col-md-4">
            <div class="card bg-dark text-warning shadow border border-success h-100">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">💰 Recette du jour</h5>
                    <p class="display-6 fw-bold text-success">
                        {{ number_format($recetteJournaliere, 0, ',', ' ') }} FCFA
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="row mt-4">
        <div class="col-md-8 mx-auto">
            <div class="card bg-dark text-warning shadow border border-warning">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center">📈 Commandes par mois</h5>
                    <canvas id="commandesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const commandesCtx = document.getElementById('commandesChart').getContext('2d');
    new Chart(commandesCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($commandesParMois->toArray())) !!},
            datasets: [{
                label: 'Commandes par mois',
                data: {!! json_encode(array_values($commandesParMois->toArray())) !!},
                backgroundColor: '#ffffff'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@endsection
@endsection
