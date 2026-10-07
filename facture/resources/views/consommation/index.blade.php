@extends('layouts.app')

@section('title', 'Liste des consommations')

@section('content')

<div class="card">

    <div class="card-body">

        <h4 class="mb-4">
            Liste des consommations
        </h4>


        {{-- Filtres --}}
        <form method="GET"
              action="{{ route('consommation.index') }}">

            <div class="row mb-4">

                {{-- Année --}}
                <div class="col-md-4">

                    <label for="annee" class="form-label">
                        Année
                    </label>

                    <select
                        name="annee"
                        id="annee"
                        class="form-control"
                        required
                    >

                        <option value="">
                            -- Choisir une année --
                        </option>

                        @for($annee = date('Y'); $annee >= 2020; $annee--)

                            <option
                                value="{{ $annee }}"
                                {{ request('annee') == $annee ? 'selected' : '' }}
                            >
                                {{ $annee }}
                            </option>

                        @endfor

                    </select>

                </div>


                {{-- Mois --}}
                <div class="col-md-4">

                    <label for="idmois" class="form-label">
                        Mois
                    </label>

                    <select
                        name="idmois"
                        id="idmois"
                        class="form-control"
                        required
                    >

                        <option value="">
                            -- Choisir un mois --
                        </option>

                        @foreach($mois as $m)

                            <option
                                value="{{ $m->id }}"
                                {{ request('idmois') == $m->id ? 'selected' : '' }}
                            >
                                {{ $m->nom }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Bouton --}}
                <div class="col-md-4 d-flex align-items-end">

    {{-- Bouton Afficher --}}
                <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="fa-solid fa-filter"></i>
                        Afficher
                    </button>


                    @if(request()->filled('annee') && request()->filled('idmois'))

                        {{-- Premier PDF --}}
                        <a
                            href="{{ route('consommation.pdf', [
                                'annee' => request('annee'),
                                'idmois' => request('idmois')
                            ]) }}"
                            class="btn btn-danger ms-2"
                        >
                            <i class="fa-solid fa-file-pdf"></i>
                            Exporter PDF
                        </a>


                        {{-- Nouveau PDF --}}
                        <a
                            href="{{ route('consommation.releves.pdf', [
                                'annee' => request('annee'),
                                'idmois' => request('idmois')
                            ]) }}"
                            class="btn btn-success ms-2"
                        >
                            <i class="fa-solid fa-file-pdf"></i>
                            Relevés PDF
                        </a>

                    @endif

                </div>
            </div>

            </div>

        </form>


        {{-- Tableau uniquement après sélection --}}
        @if(request()->filled('annee') && request()->filled('idmois'))

            @if($consommations->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>
                            <th>
                                Utilisateur
                            </th>
                        <th>
                            {{ $moisPrecedent->nom }}/{{ $anneePrecedente }}
                        </th>

                        <th>
                            {{ $moisSelectionne->nom }}/{{ request('annee') }}
                        </th>

                        <th>
                            Différence
                        </th>
                        <th>
                            Pourcentage
                        </th>
                        <th>
                            Coût total
                        </th>
                        </thead>

                        <tbody>

                            @foreach($consommations as $consommation)

                                <tr>

                                    <td>
                                        {{ $consommation->utilisateur->nom }}
                                    </td>
                                    <td>
                                            {{ $consommation->consommation_precedente ?? '-' }}
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
                        <tfoot class="table-light">

                            <tr>
                                <th colspan="3" class="text-end">
                                    Somme
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
                                     {{ $cout ? number_format( $cout->cout, 2, ',', ' ' ) : '-' }} 
                                </th>
                                
                            </tr>

                        </tfoot>
                    </table>

                </div>

            @else

                <div class="alert alert-info">

                    <i class="fa-solid fa-circle-info"></i>

                    Aucune consommation enregistrée pour
                    <strong>{{ request('idmois') }}</strong>
                    de l'année
                    <strong>{{ request('annee') }}</strong>.

                </div>

            @endif

        @endif

    </div>

</div>

@endsection
