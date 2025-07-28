<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use App\Models\Commande;
use App\Notifications\NouvelleCommandeNotification;
use App\Notifications\CommandeConfirmationNotification;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function show()
    {
        $cartItems = Card::where('user_id', auth()->id())
            ->with('burger')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->burger->prix * $item->quantite;
        });


        return view('burger.cart', compact('cartItems', 'total'));
    }

    public function update(Request $request, Card $cartItem)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $quantite = $request->input('quantite');

        if ($cartItem->burger->stock < $quantite) {
            return back()->with('error', 'Stock insuffisant');
        }

        $cartItem->update(['quantite' => $quantite]);
        return redirect()->route('cart.show')->with('success', 'Panier mis à jour !!!');
    }

    public function remove(Card $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.show')->with('success', 'Article supprimé du panier.');
    }

    public function checkout(Request $request)
    {
        $cartItems = Card::where('user_id', auth()->id())->with('burger')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Votre panier est vide.');
        }

        $commande = Commande::create([
            'user_id' => auth()->id(),
            'statut' => 'en_attente',
            'total' => $cartItems->sum(function ($item) {
                return $item->burger->prix * $item->quantite;
            }),
            'date_commande' => now(),
        ]);

        // Ajouter les burgers à la commande et mettre à jour le stock
        foreach ($cartItems as $item) {
            $commande->burger()->attach($item->burger_id, [
                'quantite' => $item->quantite,
                'user_id' => auth()->id(), // Ensure user_id is set correctly
                'prix' => $item->burger->prix,
            ]);
            $item->burger->decrement('stock', $item->quantite);
            $item->delete();
        }

        $gestionnaire = User::where('role', 'gestionnaire')->first();
        //$gestionnaire->notify(new NouvelleCommandeNotification($commande));
       // $commande->user->notify(new CommandeConfirmationNotification($commande));

        return redirect()->route('burger')->with('success', 'Commande passée avec succès.');
    }
}
