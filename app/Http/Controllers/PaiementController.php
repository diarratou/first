<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commande;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Commande $commande)
    {
        //  if ($commande->status === 'Payée') {
        //     return back()->withErrors(['paiement' => 'Cette commande est déjà payée']);
        // }

        // $request->validate([
        //     'total' => 'required|numeric|min:'.$commande->total,
        // ]);

        // $commande->update([
        //     'statut' => 'Payée',
        //     'date_paiement' => now(),
        //     'total' => $request->input('amount'),
        //    // 'payment_amount' => $validated['amount'],
        //   // $request->merge(['montant' => $request->input('amount')]),
        // ]);

        // return back()->with('success', 'Paiement enregistré');

    }

    public function payerParGestionnaire(Request $request, Commande $commande)
    {
        if ($commande->statut !== 'prete') {
            return back()->withErrors(['message' => 'La commande doit être prête avant le paiement.']);
        }

        if ($commande->statut === 'payee') {
            return back()->withErrors(['message' => 'Cette commande est déjà payée.']);
        }

        $request->validate([
            'montant' => 'required|numeric|min:' . $commande->total,
        ]);

        Paiement::create([
            'commande_id' => $commande->id,
            'montant' => $request->montant,
            'date_paiement' => now(),
        ]);

        $commande->update([
            'statut' => 'payee',
            'date_paiement' => now(),
        ]);

        return back()->with('success', 'Paiement effectué. Commande marquée comme payée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paiement $paiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paiement $paiement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paiement $paiement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paiement $paiement)
    {
        //
    }
}
