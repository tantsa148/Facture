<?php

namespace App\Http\Controllers;

use App\Models\Cout;
use App\Models\Mois;
use Illuminate\Http\Request;

class CoutController extends Controller
{
    /**
     * Afficher la liste des coûts.
     */
    public function index()
    {
        $couts = Cout::with('mois')
            ->orderByDesc('annee')
            ->orderBy('idmois')
            ->get();

        return view('cout.index', compact('couts'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $mois = Mois::all();

        return view('cout.create', compact('mois'));
    }

    /**
     * Enregistrer un nouveau coût.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idmois' => 'required|exists:mois,id',
            'annee' => 'required|integer|min:2000|max:2100',
            'cout' => 'required|numeric|min:0',
        ]);

        $existe = Cout::where('idmois', $request->idmois)
            ->where('annee', $request->annee)
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors([
                    'cout' => 'Un coût existe déjà pour ce mois et cette année.'
                ]);
        }

        Cout::create([
            'idmois' => $request->idmois,
            'annee' => $request->annee,
            'cout' => $request->cout,
        ]);

        return redirect()
            ->route('cout.index')
            ->with('success', 'Le coût a été enregistré.');
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Cout $cout)
    {
        $mois = Mois::all();

        return view('cout.edit', compact(
            'cout',
            'mois'
        ));
    }

    /**
     * Mettre à jour un coût.
     */
    public function update(Request $request, Cout $cout)
    {
        $request->validate([
            'idmois' => 'required|exists:mois,id',
            'annee' => 'required|integer|min:2000|max:2100',
            'cout' => 'required|numeric|min:0',
        ]);

        $existe = Cout::where('idmois', $request->idmois)
            ->where('annee', $request->annee)
            ->where('id', '!=', $cout->id)
            ->exists();

        if ($existe) {
            return back()
                ->withInput()
                ->withErrors([
                    'cout' => 'Un coût existe déjà pour ce mois et cette année.'
                ]);
        }

        $cout->update([
            'idmois' => $request->idmois,
            'annee' => $request->annee,
            'cout' => $request->cout,
        ]);

        return redirect()
            ->route('cout.index')
            ->with('success', 'Le coût a été modifié.');
    }

    /**
     * Supprimer un coût.
     */
    public function destroy(Cout $cout)
    {
        $cout->delete();

        return redirect()
            ->route('cout.index')
            ->with('success', 'Le coût a été supprimé.');
    }
}
