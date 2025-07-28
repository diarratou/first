@extends('welcome')

@section('content')
    <div class="container py-5" style="background-color: #000; color: #f1c40f; min-height: 100vh;">
        <h1 class="text-center mb-5 display-6 fw-bold text-warning">🧾 Détails de la commande #{{ $commande->id }}</h1>

        <div class="table-responsive mb-5">
            <table class="table table-bordered border-warning table-dark text-warning">
                <tbody>
                    <tr>
                        <th scope="row" class="text-warning">👤 Utilisateur</th>
                        <td>{{ $commande->user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-warning">📦 Statut</th>
                        <td>{{ ucfirst($commande->statut) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-warning">💰 Total</th>
                        <td>{{ number_format($commande->total) }} FCFA</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-warning">📅 Date de commande</th>
                        <td>{{ $commande->date_commande }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card bg-dark border border-warning text-warning shadow-lg">
            <div class="card-header bg-warning text-black fw-bold">
                ✏️ Mettre à jour le statut de la commande
            </div>
            <div class="card-body">
                <form action="{{ route('updateCommande', $commande->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="statut" class="form-label fw-bold">📌 Nouveau statut :</label>
                        <select name="statut" id="statut" class="form-select bg-black border border-warning text-warning">
                            <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>🕓 En attente</option>
                            <option value="en_preparation" {{ $commande->statut == 'en_preparation' ? 'selected' : '' }}>👨‍🍳 En préparation</option>
                            <option value="prete" {{ $commande->statut == 'prete' ? 'selected' : '' }}>✅ Prête</option>
                            <option value="payee" {{ $commande->statut == 'payee' ? 'selected' : '' }}>💳 Payée</option>
                        </select>
                    </div>

                    <div id="montant_paye_section" class="mb-4" style="display: none;">
                        <label for="montant_paye" class="form-label fw-bold">💵 Montant payé :</label>
                        <input type="number" name="montant_paye" id="montant_paye"
                            class="form-control bg-black border border-warning text-warning" step="0.01">
                    </div>

                    <button type="submit" class="btn btn-warning fw-bold px-4">💾 Enregistrer</button>
                </form>
                @if($commande->statut === 'prete')
                    <form method="POST" action="{{ route('commandes.payer.gestionnaire', $commande->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="montant">Montant reçu (en FCFA)</label>
                            <input type="number" name="montant" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Payer en espèces</button>
                    </form>
                @endif

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
@endsection
