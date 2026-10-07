<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>
        Relevés {{ $annee }}
    </title>

    <style>

        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /*
         * Conteneur d'un relevé
         */
        .releve {
            width: 100%;
            margin: 0;
            padding: 0 0 20px 0;
        }

        /*
         * Espace entre deux relevés
         */
        .espace {
            height: 20px;
        }

        /*
         * Trait de séparation
         */
        .separation {
            border-top: 1px solid #555;
            height: 1px;
        }

        /*
         * Tableau principal du relevé
         */
        .table-releve {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        /*
         * En-tête OASIS + utilisateur
         */
        .entete {
            border: 1px solid #888;
            text-align: center;
            padding: 7px;
            font-size: 15px;
            font-weight: bold;
        }

        /*
         * Colonnes
         */
        .table-releve th,
        .table-releve td {
            border: 1px solid #888;
            padding: 7px;
            text-align: center;
            vertical-align: middle;
        }

        /*
         * En-tête des colonnes
         */
        .table-releve th {
            font-weight: normal;
        }

        /*
         * Ligne des totaux
         */
        .total td {
            font-weight: bold;
        }

        /*
         * Texte "Total Consommation"
         */
        .total-label {
            text-align: left !important;
        }

    </style>

</head>


<body>

@foreach($consommations as $index => $consommation)

    {{-- =============================== --}}
    {{-- RELEVE UTILISATEUR               --}}
    {{-- =============================== --}}

    <table class="table-releve">

        {{-- En-tête --}}
        <tr>

            <td colspan="5" class="entete">

                {{ $consommation->utilisateur->nom }}

            </td>

        </tr>


        {{-- Titres des colonnes --}}
        <tr>

            <th>
                {{ $moisPrecedent->nom }}/{{ $anneePrecedente }}
            </th>

            <th>
                {{ $moisSelectionne->nom }}/{{ $annee }}
            </th>

            <th>
                Conso en KWH
            </th>

            <th>
                Conso en %
            </th>

            <th>
                Cout
            </th>

        </tr>


        {{-- Données utilisateur --}}
        <tr>

            {{-- Consommation précédente --}}
            <td>

                {{ $consommation->consommation_precedente !== null

                    ? number_format(
                        $consommation->consommation_precedente,
                        2,
                        ',',
                        ' '
                    )

                    : '-'
                }}

            </td>


            {{-- Consommation actuelle --}}
            <td>

                {{ number_format(
                    $consommation->consommation,
                    2,
                    ',',
                    ' '
                ) }}

            </td>


            {{-- Différence de consommation --}}
            <td>

                {{ $consommation->difference !== null

                    ? number_format(
                        $consommation->difference,
                        2,
                        ',',
                        ' '
                    )

                    : '-'
                }}

            </td>


            {{-- Pourcentage --}}
            <td>

                {{ $consommation->pourcentage_difference !== null

                    ? number_format(
                        $consommation->pourcentage_difference,
                        2,
                        ',',
                        ' '
                    ) . ' %'

                    : '-'
                }}

            </td>

            {{-- Coût utilisateur --}}
            <td>

                {{ $consommation->cout_utilisateur !== null

                    ? number_format(
                        $consommation->cout_utilisateur,
                        0,
                        ',',
                        ' '
                    ) . ' Ar'

                    : '-'
                }}

            </td>

        </tr>


        {{-- Total --}}
        <tr class="total">

            <td colspan="2" class="total-label">
                Total Consommation
            </td>

            <td>

                {{ number_format(
                    $sommeDifference,
                    2,
                    ',',
                    ' '
                ) }}

            </td>

            <td>
                100,00 %
            </td>

            <td>

                {{ $cout

                    ? number_format(
                        $cout->cout,
                        2,
                        ',',
                        ' '
                    ) . ' Ar'

                    : '-'
                }}

            </td>

        </tr>

    </table>


    {{-- =============================== --}}
    {{-- SEPARATION ENTRE UTILISATEURS   --}}
    {{-- =============================== --}}

    @if(!$loop->last)

        <div class="espace"></div>

        <div class="separation"></div>

        <div class="espace"></div>

    @endif


@endforeach

</body>

</html>