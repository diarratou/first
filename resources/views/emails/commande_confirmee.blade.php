<h1>Bonjour {{ $commande->user->name }},</h1>

<p>Merci pour votre commande ! Voici les détails :</p>

<ul>
    @foreach($commande->burger as $item)
        <li>{{ $item->nom }} x {{ $item->pivot->quantite }}</li>
    @endforeach
</ul>

<p>Total : {{ $commande->total }} €</p>

<p>Nous vous contacterons bientôt.</p>
<p>Merci de votre confiance !</p>
<p>Cordialement,</p>
<p>L'équipe de Burger</p>
