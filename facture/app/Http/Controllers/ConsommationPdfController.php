<?php

namespace App\Http\Controllers;

use App\Models\Consommation;
use App\Models\Cout;
use App\Models\Mois;
use App\Services\ConsommationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ConsommationPdfController extends Controller
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

        // Mois sélectionné
        $moisSelectionne = Mois::findOrFail($idMois);

        // Consommations
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

        // Génération du PDF
        $pdf = Pdf::loadView(
            'consommation.pdf',
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

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream(
            'consommation-' .
            $moisSelectionne->nom .
            '-' .
            $annee .
            '.pdf'
        );
    }
}
