<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Mois;
use App\Models\Consommation;
use Illuminate\Http\Request;
use App\Services\ConsommationService;
use App\Models\Cout;

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

    public function index(
        Request $request,
        ConsommationService $service
    ) {
        $request->validate([
            'annee' => 'nullable|integer|min:2000|max:2100',
            'idmois' => 'nullable|exists:mois,id',
        ]);

        $consommations = collect();

        $moisSelectionne = null;
        $moisPrecedent = null;
        $anneePrecedente = null;

        $sommeDifference = 0;
        $cout = null;

        if (
            $request->filled('annee')
            && $request->filled('idmois')
        ) {

            $annee = (int) $request->annee;
            $idMois = (int) $request->idmois;

            // Mois sélectionné
            $moisSelectionne = Mois::find($idMois);

            // Récupérer les consommations
            $consommations =
                $service->getConsommationsAvecDifference(
                    $annee,
                    $idMois
                );

            // Somme des différences
            $sommeDifference =
                $service->calculerSommeDifference(
                    $consommations
                );

            // Calcul des pourcentages
            $consommations =
                $service->calculerPourcentagesDifference(
                    $consommations,
                    $sommeDifference
                );

            // Mois précédent
            $precedent =
                $service->getMoisPrecedentModel(
                    $annee,
                    $idMois
                );

            $moisPrecedent = $precedent['mois'];
            $anneePrecedente = $precedent['annee'];

            // Récupérer le coût total
            $cout = Cout::where('idmois', $idMois)
                ->where('annee', $annee)
                ->first();

            /*
            * Calculer le coût de chaque utilisateur.
            */
            foreach ($consommations as $consommation) {

                $consommation->cout_utilisateur =
                    $service->coutUtilisateur(
                        $cout?->cout,
                        $consommation->pourcentage_difference
                    );
            }
        }

        // Liste des mois pour le filtre
        $mois = Mois::all();

        return view(
            'consommation.index',
            compact(
                'consommations',
                'mois',
                'moisSelectionne',
                'moisPrecedent',
                'anneePrecedente',
                'sommeDifference',
                'cout'
            )
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'annee' => 'required|integer|min:2000|max:2100',
            'idmois' => 'required|exists:mois,id',
            'consommations' => 'required|array',
            'consommations.*' => 'required|numeric|min:0',
            'cout' => 'required|numeric|min:0',
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
        /* * Vérifier si le coût existe déjà */
        $coutExiste = Cout::where('idmois', $request->idmois) ->where('annee', $request->annee) ->exists();
         if ($coutExiste) { 
            return back() ->withInput() ->withErrors([ 'cout' => 'Un coût existe déjà pour ce mois et cette année.' ]);
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
        /* * Enregistrer le coût */ 
        Cout::create([
             'idmois' => $request->idmois,
             'annee' => $request->annee,
             'cout' => $request->cout, ]);

        return redirect()
            ->route('consommation.create')
            ->with('success', 'Les consommations ont été enregistrées.');
    }
}
