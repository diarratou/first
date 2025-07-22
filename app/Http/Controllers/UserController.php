<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Afficher la liste paginée des utilisateurs
    public function index()
    {
        $users = User::paginate(10);
        return view('user.user', compact('users'));
    }

    // Afficher le formulaire d'ajout
    public function create()
    {
        $user = new User();
        return view('user.addUser', compact('user'));
    }

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user')->with('message', 'Utilisateur ajouté avec succès');
    }

    // Afficher le formulaire de modification
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.addUser', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $photoName);
            $user->photo = $photoName;
        }
        $user->save();

        return redirect()->route('user')->with('message', 'Utilisateur modifié avec succès');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user')->with('messageDelete', 'Utilisateur supprimé avec succès.');
    }
}
