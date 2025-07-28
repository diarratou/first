<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CommandeBurger;
use Illuminate\Http\Request;

class CommandeBurgerController extends Controller {
    public function show()
    {
        $cartItems = CommandeBurger::where('user_id', auth()->id())
                        ->with('burger')
                        ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->burger->prix * $item->quantite;
        });

        return view('cart.show', compact('cartItems', 'total'));
    }

    public function update(Request $request, CommandeBurger $cartItem)
    {
        $quantite = $request->input('quantite');

        if ($cartItem->burger->stock < $quantite) {
            return back()->with('error', 'Stock insuffisant.');
        }

        $cartItem->update(['quantite' => $quantite]);
        return redirect()->route('cart.show')->with('success', 'Panier mis à jour.');
    }

    public function remove(CommandeBurger $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.show')->with('success', 'Article supprimé du panier.');
    }

    public function checkout(Request $request)
    {
        $cartItems = CommandeBurger::where('user_id', auth()->id())->with('burger')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Votre panier est vide.');
        }

        $commande = CommandeBurger::create([
            'user_id' => auth()->id(),
            'status' => 'en_attente',
            'total' => $cartItems->sum(function ($item) {
                return $item->burger->price * $item->quantite;
            })
        ]);

        // Ajouter les burgers à la commande et mettre à jour le stock
        foreach ($cartItems as $item) {
            $commande->burgers()->attach($item->burger_id, ['quantite' => $item->quantite]);
            $item->burger->decrement('stock', $item->quantite);
            $item->delete();
        }

        // Notifications comme dans votre code original
        $gestionnaire = User::where('role', 'gestionnaire')->first();
        // $gestionnaire->notify(new NouvelleCommandeNotification($commande));
        // $commande->user->notify(new CommandeConfirmationNotification($commande));

        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès.');
    }

     public function facture(Commande $commande)
    {
        // Télécharger la facture en PDF
        // Utilisation de DomPDF ou une autre bibliothèque pour générer le PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('facture', compact('commande'));
        return $pdf->download('facture_' . $commande->id . '.pdf');
    }
}
