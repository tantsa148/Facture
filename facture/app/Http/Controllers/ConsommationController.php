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

    public function store(Request $request)
    {
        $request->validate([
            'idmois' => 'required|exists:mois,id',
            'consommations' => 'required|array',
            'consommations.*' => 'required|numeric|min:0',
        ]);

        foreach ($request->consommations as $idutilisateur => $valeur) {

            Consommation::create([
                'idutilisateur' => $idutilisateur,
                'idmois' => $request->idmois,
                'consommation' => $valeur,
            ]);
        }

        return redirect()
            ->route('consommation.create')
            ->with('success', 'Les consommations ont été enregistrées.');
    }
}