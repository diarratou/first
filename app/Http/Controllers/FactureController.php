<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $commandes = Commande::with(['burger', 'user'])
                ->where('user_id', auth()->id())
                ->where('statut', 'payee')
                ->get();

        return view('factures.pdf', compact('commandes'));
        //
    }

     public function genererFacture(Commande $commande)
    {
        if ($commande->statut !== 'payee') {
            return back()->withErrors(['message' => 'La facture n\'est disponible qu\'après le paiement.']);
        }

        $pdf = Pdf::loadView('factures.facture', compact('commande'));
        return $pdf->stream('facture_commande_' . $commande->id . '.pdf');
    }

    public function telechargerPdf(Commande $commande)
    {
        if ($commande->statut !== 'payee') {
            return redirect()->back()->with('error', 'La facture est disponible uniquement après paiement.');
        }

        if ($commande->user_id !== auth()->id()) {
            abort(403);
        }
        $commandes = Commande::where('user_id', auth()->id())
            ->where('statut', 'payee')
            ->get();


        $pdf = Pdf::loadView('factures.tel', compact('commandes'));
        return $pdf->download('facture_commande_' . $commande->id . '.pdf');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
