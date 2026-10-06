<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Mois;
use App\Models\Consommation;
use Illuminate\Http\Request;

class ConsommationController extends Controller
{
    public function create()
    {
        $utilisateurs = Utilisateur::all();
        $mois = Mois::all();

        return view('consommation.create', compact(
            'utilisateurs',
            'mois'
        ));
    }

    public function index(Request $request)
    {
        $request->validate([
            'annee' => 'nullable|integer|min:2000|max:2100',
            'idmois' => 'nullable|exists:mois,id',
        ]);

        $consommations = collect();

        // Afficher les consommations uniquement
        // si l'année ET le mois sont sélectionnés
        if ($request->filled('annee') && $request->filled('idmois')) {

            $consommations = Consommation::with(['utilisateur', 'mois'])
                ->where('annee', $request->annee)
                ->where('idmois', $request->idmois)
                ->orderBy('idutilisateur')
                ->get();
        }

        $mois = Mois::all();

        return view('consommation.index', compact(
            'consommations',
            'mois'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'annee' => 'required|integer|min:2000|max:2100',
            'idmois' => 'required|exists:mois,id',
            'consommations' => 'required|array',
            'consommations.*' => 'required|numeric|min:0',
        ]);

        // Vérifier si des consommations existent déjà
        foreach ($request->consommations as $idutilisateur => $valeur) {

            $existe = Consommation::where('idutilisateur', $idutilisateur)
                ->where('idmois', $request->idmois)
                ->where('annee', $request->annee)
                ->exists();

            if ($existe) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'consommations' => 'Une consommation existe déjà pour cet utilisateur, ce mois et cette année.'
                    ]);
            }
        }

        // Enregistrer les consommations
        foreach ($request->consommations as $idutilisateur => $valeur) {

            Consommation::create([
                'idutilisateur' => $idutilisateur,
                'idmois' => $request->idmois,
                'annee' => $request->annee,
                'consommation' => $valeur,
            ]);
        }

        return redirect()
            ->route('consommation.create')
            ->with('success', 'Les consommations ont été enregistrées.');
    }
}
