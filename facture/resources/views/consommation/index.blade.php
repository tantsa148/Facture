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

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fa-solid fa-filter"></i>

                        Afficher

                    </button>

                </div>

            </div>

        </form>


        {{-- Tableau uniquement après sélection --}}
        @if(request()->filled('annee') && request()->filled('idmois'))

            @if($consommations->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>
                                <th>Utilisateur</th>
                                <th>Mois</th>
                                <th>Année</th>
                                <th>Consommation</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($consommations as $consommation)

                                <tr>

                                    <td>
                                        {{ $consommation->utilisateur->nom }}
                                    </td>

                                    <td>
                                        {{ $consommation->mois->nom }}
                                    </td>

                                    <td>
                                        {{ $consommation->annee }}
                                    </td>

                                    <td>
                                        {{ number_format(
                                            $consommation->consommation,
                                            2,
                                            ',',
                                            ' '
                                        ) }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

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
