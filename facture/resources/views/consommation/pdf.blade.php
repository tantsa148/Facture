<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>
        Consommation {{ $moisSelectionne->nom }} {{ $annee }}
    </title>

    <style>

        @page {
            margin: 30px 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        .titre {
            text-align: center;
            margin-bottom: 25px;
        }

        .titre h1 {
            margin: 0;
            font-size: 20px;
        }

        .titre p {
            margin-top: 5px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #555;
            padding: 7px;
        }

        th {
            background-color: #eeeeee;
            text-align: center;
        }

        td {
            text-align: right;
        }

        td:first-child {
            text-align: left;
        }

        tfoot th {
            background-color: #dddddd;
            font-weight: bold;
        }

        .montant {
            text-align: right;
        }

    </style>

</head>

<body>

    <div class="titre">

        <h1>
            Liste des consommations
        </h1>

        <p>
            {{ $moisSelectionne->nom }} {{ $annee }}
        </p>

    </div>


    <table>

        <thead>

            <tr>

                <th>
                    Utilisateur
                </th>

                <th>
                    {{ $moisPrecedent->nom }}/{{ $anneePrecedente }}
                </th>

                <th>
                    {{ $moisSelectionne->nom }}/{{ $annee }}
                </th>

                <th>
                    Différence
                </th>

                <th>
                    Pourcentage
                </th>

                <th>
                    Coût utilisateur
                </th>

            </tr>

        </thead>


        <tbody>

            @foreach($consommations as $consommation)

                <tr>

                    <td>
                        {{ $consommation->utilisateur->nom }}
                    </td>

                    <td>
                        {{ $consommation->consommation_precedente !== null
                            ? number_format(
                                $consommation->consommation_precedente,
                                2,
                                ',',
                                ' '
                            )
                            : '-' }}
                    </td>

                    <td>
                        {{ number_format(
                            $consommation->consommation,
                            2,
                            ',',
                            ' '
                        ) }}
                    </td>

                    <td>
                        {{ $consommation->difference !== null
                            ? number_format(
                                $consommation->difference,
                                2,
                                ',',
                                ' '
                            )
                            : '-' }}
                    </td>

                    <td>
                        {{ $consommation->pourcentage_difference !== null
                            ? number_format(
                                $consommation->pourcentage_difference,
                                2,
                                ',',
                                ' '
                            ) . ' %'
                            : '-' }}
                    </td>

                    <td>
                        {{ $consommation->cout_utilisateur !== null
                            ? number_format(
                                $consommation->cout_utilisateur,
                                2,
                                ',',
                                ' '
                            )
                            : '-' }}
                    </td>

                </tr>

            @endforeach

        </tbody>


        <tfoot>

            <tr>

                <th colspan="3">
                    Totaux
                </th>

                <th>
                    {{ number_format(
                        $sommeDifference,
                        2,
                        ',',
                        ' '
                    ) }}
                </th>

                <th>
                    100 %
                </th>

                <th>
                    {{ $cout
                        ? number_format(
                            $cout->cout,
                            2,
                            ',',
                            ' '
                        )
                        : '-' }}
                </th>

            </tr>

        </tfoot>

    </table>

</body>

</html>
