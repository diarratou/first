<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Card;
use Illuminate\Http\Request;

class BurgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
         $query = Burger::query();

        // Filtrer par nom
        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->nom . '%');
        }
        // Filtrer par prix
        if ($request->filled('prix')) {
            $query->where('prix', '=', $request->prix);
        }


        $burgers = $query->paginate(5);
        return view('burger.burger',compact('burgers'));

    }

    public function addToCart(Request $request, Burger $burger)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour ajouter au panier.');
        }

        $quantite = $request->input('quantite', 1);

        if (!is_numeric($quantite) || $quantite <= 0) {
            return back()->with('error', 'Quantité invalide');
        }

        if ($burger->stock < $quantite) {
            return back()->with('error', 'Stock insuffisant');
        }

        $cartItem = Card::where('user_id', auth()->id())
            ->where('burger_id', $burger->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantite += $quantite;
            $cartItem->save();
        } else {
            Card::create([
                'user_id' => auth()->id(),
                'burger_id' => $burger->id,
                'quantite' => $quantite
            ]);
        }

        return redirect()->route('cart.show')->with('success', 'Burger ajouté au panier');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $burger = new \App\Models\Burger();
        return view('burger.addBurger', compact('burger'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        if($request->file('image')){
            $path = $request->file('image')->store('images','public');
        }
        $burger = new \App\Models\Burger();
        $burger->nom = $request->nom;
        $burger->prix = $request->prix;
        $burger->image = $request->file('image') ?$path : null;
        $burger->description = $request->description;
        $burger->stock = $request->stock;
        $burger->save();

        return redirect('burger')->with("message", "Burger ajouté avec succes");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $burger = Burger::findOrFail($id);
        return view('burger.showBurger', compact('burger'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $burger = Burger::find($id);

        return view('burger.addburger',compact('burger'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
        ]);

        $burger = Burger::find($id);

        $burger->update($request->only(['nom', 'prix', 'description', 'stock']));

        return redirect('burger')->with("message", "Burger modifié avec succes");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Burger::destroy($id);
        $burger = \App\Models\Burger::find($id);
        $burger->delete();

        return redirect('burger')->with("messageDelete", "Burger supprimé avec succes");

    }

    public function archiver($id)
    {
        $burger = Burger::findOrFail($id);
        $burger->archive = true;
        $burger->save();

        return redirect()->route('burgers.archives')->with('success', 'Burger archivé avec succès.');
    }

    public function desarchiver($id)
    {
        $burger = Burger::findOrFail($id);
        $burger->archive = false;
        $burger->save();

        return redirect()->back()->with('success', 'Burger desarchivé avec succès.');
    }

    public function archives()
    {
        $burgers = Burger::where('archive', true)->get();

        return view('burger.archiveBurger', compact('burgers'));
    }


}
