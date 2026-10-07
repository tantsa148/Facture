<?php

namespace App\Services;

use App\Models\Consommation;
use App\Models\Mois;

class ConsommationService
{
    /**
     * Récupérer les consommations d'une année et d'un mois.
     */
    public function getConsommations(int $annee, int $idMois)
    {
        return Consommation::with([
            'utilisateur',
            'mois'
        ])
        ->where('annee', $annee)
        ->where('idmois', $idMois)
        ->orderBy('idutilisateur')
        ->get();
    }

    /**
     * Déterminer l'année et le mois précédent.
     *
     * Exemple :
     * Janvier 2026 → Décembre 2025
     * Mai 2026     → Avril 2026
     */
    public function getMoisPrecedent(int $annee, int $idMois)
    {
        if ($idMois == 1) {
            return [
                'annee' => $annee - 1,
                'idmois' => 12
            ];
        }

        return [
            'annee' => $annee,
            'idmois' => $idMois - 1
        ];
    }

    /**
     * Récupérer la consommation précédente
     * d'un utilisateur.
     */
    public function getConsommationPrecedente(
        int $idUtilisateur,
        int $annee,
        int $idMois
    ) {
        $moisPrecedent = $this->getMoisPrecedent(
            $annee,
            $idMois
        );

        return Consommation::where(
            'idutilisateur',
            $idUtilisateur
        )
        ->where(
            'annee',
            $moisPrecedent['annee']
        )
        ->where(
            'idmois',
            $moisPrecedent['idmois']
        )
        ->first();
    }

    /**
     * Calculer la différence entre
     * la consommation actuelle et précédente.
     */
    public function calculerDifference(
        $consommationActuelle,
        $consommationPrecedente
    ) {
        if ($consommationPrecedente === null) {
            return null;
        }

        return $consommationActuelle
            - $consommationPrecedente;
    }

    /**
     * Récupérer le modèle du mois précédent
     * ainsi que son année.
     */
    public function getMoisPrecedentModel(
        int $annee,
        int $idMois
    ) {
        $precedent = $this->getMoisPrecedent(
            $annee,
            $idMois
        );

        return [
            'mois' => Mois::find(
                $precedent['idmois']
            ),
            'annee' => $precedent['annee']
        ];
    }

    /**
     * Récupérer les consommations avec :
     * - consommation précédente
     * - différence
     */
    public function getConsommationsAvecDifference(
        int $annee,
        int $idMois
    ) {
        $consommations = $this->getConsommations(
            $annee,
            $idMois
        );

        foreach ($consommations as $consommation) {

            $precedente = $this->getConsommationPrecedente(
                $consommation->idutilisateur,
                $annee,
                $idMois
            );

            $consommation->consommation_precedente =
                $precedente?->consommation;

            $consommation->difference =
                $this->calculerDifference(
                    $consommation->consommation,
                    $consommation->consommation_precedente
                );
        }

        return $consommations;
    }
    public function calculerSommeDifference($consommations) { return $consommations->sum(function ($consommation) { 
         if ($consommation->difference === null) { return 0;
             } return $consommation->difference; 
              });
     }
     
    public function calculerPourcentagesDifference(
        $consommations,
        $sommeDifference
    ) {
        foreach ($consommations as $consommation) {

            if (
                $consommation->difference === null
                || $sommeDifference == 0
            ) {
                $consommation->pourcentage_difference = null;
            } else {
                $consommation->pourcentage_difference =
                    ($consommation->difference / $sommeDifference) * 100;
            }
        }

        return $consommations;
    }
      public function coutUtilisateur(
        $coutTotal,
        $pourcentage
    ) {
        if ($coutTotal === null || $pourcentage === null) {
            return null;
        }

        return ($coutTotal * $pourcentage) / 100;
    }
}
