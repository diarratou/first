<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Burger;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();

        $commandesEnCours = Commande::whereDate('created_at', $today)
            ->where('statut', 'en_attente')
            ->get();

        $commandesValidees = Commande::whereDate('updated_at', $today)
            ->where('statut', 'payee')
            ->get();

        $recetteJournaliere = Commande::whereDate('updated_at', $today)
            ->where('statut', 'payee')
            ->sum('total');

         $commandesParMois = Commande::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as total')
             ->groupBy('month')
             ->get();

        //  $commandesParMois = Commande::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as total')
        //     ->whereYear('created_at', now()->year)
        //     ->groupByRaw('month')
        //     ->pluck('total', 'month');

        // $labels = $commandesParMois->pluck('month')->map(function($m) {
        //     return DateTime::createFromFormat('!m', $m)->format('F'); // pour avoir Jan, Feb...
        // });
        // $totals = $commandesParMois->pluck('total');


        return view('statistique.index', compact('commandesEnCours', 'commandesValidees', 'recetteJournaliere', 'commandesParMois'));

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
