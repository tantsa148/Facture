<?php

namespace App\Http\Controllers;

use App\Models\Cout;
use App\Models\Mois;
use App\Services\ConsommationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ConsommationRelevePdfController extends Controller
{
    public function export(
        Request $request,
        ConsommationService $service
    ) {
        $request->validate([
            'annee' => 'required|integer|min:2000|max:2100',
            'idmois' => 'required|exists:mois,id',
        ]);

        $annee = (int) $request->annee;
        $idMois = (int) $request->idmois;

        $moisSelectionne = Mois::findOrFail($idMois);

        // Consommations du mois sélectionné
        $consommations =
            $service->getConsommationsAvecDifference(
                $annee,
                $idMois
            );

        // Total des différences
        $sommeDifference =
            $service->calculerSommeDifference(
                $consommations
            );

        // Pourcentages
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

        // Coût total
        $cout = Cout::where('idmois', $idMois)
            ->where('annee', $annee)
            ->first();

        // Coût de chaque utilisateur
        foreach ($consommations as $consommation) {

            $consommation->cout_utilisateur =
                $service->coutUtilisateur(
                    $cout?->cout,
                    $consommation->pourcentage_difference
                );
        }

        $pdf = Pdf::loadView(
            'consommation.releve-pdf',
            compact(
                'consommations',
                'moisSelectionne',
                'moisPrecedent',
                'annee',
                'anneePrecedente',
                'sommeDifference',
                'cout'
            )
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'releves-' .
            $moisSelectionne->nom .
            '-' .
            $annee .
            '.pdf'
        );
    }
}