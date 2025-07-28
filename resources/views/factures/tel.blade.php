
    <div class="container py-5" style="background-color: #000; color: #f1c40f;">
        <h1 class="text-center mb-4">🧾 Factures IPP BURGER</h1>

        @foreach ($commandes as $commande)
            <div class="mb-5 p-4" style="background-color: #111; border-radius: 10px;">
                <h3>Commande n°{{ $commande->id }}</h3>
                <p><strong>Date :</strong> {{ $commande->date_commande ?? $commande->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Client :</strong> {{ $commande->user->name ?? 'N/A' }}</p>

                <table class="table table-bordered table-dark mt-3">
                    <thead>
                        <tr>
                            <th>Burger</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commande->burger as $burger)
                            <tr>
                                <td>{{ $burger->nom }}</td>
                                <td>{{ $burger->pivot->quantite ?? 1 }}</td>
                                <td>{{ number_format($burger->prix, 0, ',', ' ') }} FCFA</td>
                                <td>
                                    {{ number_format($burger->prix * ($burger->pivot->quantite ?? 1), 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 class="text-end mt-3">Total : {{ number_format($commande->total, 0, ',', ' ') }} FCFA</h5>
            </div>
        @endforeach
    </div>


