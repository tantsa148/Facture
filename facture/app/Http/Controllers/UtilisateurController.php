<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    // Afficher la liste
    public function index()
    {
        $utilisateurs = Utilisateur::all();

        return view('utilisateur.index', compact('utilisateurs'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('utilisateur.create');
    }

    // Enregistrer
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Utilisateur::create([
            'nom' => $request->nom,
        ]);

        return redirect()
            ->route('utilisateur.index')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }

    // Afficher un utilisateur
    public function show(Utilisateur $utilisateur)
    {
        return view('utilisateur.show', compact('utilisateur'));
    }

    // Afficher le formulaire de modification
    public function edit(Utilisateur $utilisateur)
    {
        return view('utilisateur.edit', compact('utilisateur'));
    }

    // Modifier
    public function update(Request $request, Utilisateur $utilisateur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $utilisateur->update([
            'nom' => $request->nom,
        ]);

        return redirect()
            ->route('utilisateur.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }

    // Supprimer
    public function destroy(Utilisateur $utilisateur)
    {
        $utilisateur->delete();

        return redirect()
            ->route('utilisateur.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
