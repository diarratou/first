@extends('welcome')

@section('content')
  <div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-yellow-400">Votre Panier</h1>

    @if(session('panier') && count(session('panier')) > 0)
      <div class="bg-black rounded-lg shadow border border-yellow-500 p-6 text-yellow-300">
        <table class="w-full">
          <thead>
            <tr class="text-left border-b border-yellow-500 text-yellow-400">
              <th class="pb-2">Produit</th>
              <th class="pb-2">Prix</th>
              <th class="pb-2">Quantité</th>
              <th class="pb-2">Total</th>
              <th class="pb-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            @php $total = 0; @endphp
            @foreach(session('panier') as $id => $item)
              @php $total += $item['prix'] * $item['quantite']; @endphp
              <tr class="border-t border-yellow-700 hover:bg-yellow-900 transition">
                <td class="py-2">{{ $item['nom'] }}</td>
                <td class="py-2">{{ number_format($item['prix'], 2) }} FCFA</td>
                <td class="py-2">
                  <form method="POST" action="{{ route('panier.quantite', $id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1" class="w-16 px-2 py-1 bg-black text-yellow-300 border border-yellow-400 rounded">
                    <button class="text-sm text-yellow-400 hover:underline ml-2">Mettre à jour</button>
                  </form>
                </td>
                <td class="py-2">{{ number_format($item['prix'] * $item['quantite'], 2) }} FCFA</td>
                <td class="py-2">
                  <form method="POST" action="{{ route('panier.supprimer', $id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:underline">Supprimer</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="flex justify-between items-center mt-6 flex-wrap gap-4">
          <form method="POST" action="{{ route('panier.vider') }}">
            @csrf
            <button class="bg-yellow-400 text-black font-bold px-4 py-2 rounded hover:bg-yellow-500 transition">
              Vider le panier
            </button>
          </form>

          <div class="text-right">
            <p class="text-lg font-bold mb-2 text-yellow-200">
              Total : {{ number_format($total, 2) }} FCFA
            </p>

            @auth
              <form method="POST" action="{{ route('valider_panier') }}">
                @csrf
                <button id="valider-panier-bt" type="submit" class="inline-block bg-yellow-500 text-black px-6 py-2 rounded font-semibold hover:bg-yellow-600 transition">
                  Valider la commande
                </button>
              </form>
            @endauth

            @guest
              <a href="{{ route('login') }}" class="inline-block bg-yellow-500 text-black px-6 py-2 rounded font-semibold hover:bg-yellow-600 transition">
                Se connecter pour commander
              </a>
            @endguest
          </div>
        </div>
      </div>
    @else
      <div class="text-center text-yellow-400">
        <h2 class="text-xl mb-4">Votre panier est vide.</h2>
        <a href="/menu" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition">Voir le menu</a>
      </div>
    @endif
  </div>
@endsection
