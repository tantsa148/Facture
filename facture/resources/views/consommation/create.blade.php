@extends('layouts.app')

@section('title', 'Saisie des consommations')

@section('content')

<style>
    /* Carte principale */
    .consommation-card {
        width: 90%;
        margin: 20px auto;
    }

    /* En-tête */
    .header-consommation {
        width: 85%;
        margin: 0 auto 20px auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-consommation .card-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .header-consommation .card-subtitle {
        color: #6c757d;
        font-weight: 400;
        margin-bottom: 0;
    }

    /* Sélection du mois */
    .mois-container {
        width: 85%;
        margin: 0 auto 25px auto;
    }

    .mois-container label {
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* Tableau */
    .consommation-table-container {
        width: 85%;
        margin: 0 auto;
    }

    .consommation-table {
        width: 100%;
        text-align: left;
    }

    .consommation-table th {
        font-weight: 600;
    }

    .consommation-table td,
    .consommation-table th {
        vertical-align: middle;
        padding: 12px 15px;
    }

    /* Colonnes */
    .consommation-table th:first-child {
        width: 60%;
    }

    .consommation-table th:last-child {
        width: 40%;
    }

    /* Champ consommation */
    .consommation-input {
        max-width: 250px;
    }

    /* Bouton enregistrer */
    .save-container {
        width: 85%;
        margin: 20px auto 0 auto;
        display: flex;
        justify-content: flex-end;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .consommation-card {
            width: 100%;
            margin: 10px auto;
        }

        .header-consommation,
        .mois-container,
        .consommation-table-container,
        .save-container {
            width: 100%;
        }

        .header-consommation {
            flex-direction: column;
            align-items: flex-start;
        }

        .save-container {
            justify-content: flex-start;
        }

        .consommation-input {
            max-width: 100%;
        }
    }
</style>


<div class="card consommation-card">

    <div class="card-body">

        {{-- En-tête --}}
        <div class="header-consommation">

            <div>

                <h4 class="card-title">
                    Saisie des consommations
                </h4>

                <h6 class="card-subtitle">
                    Enregistrer la consommation de chaque utilisateur pour un mois donné.
                </h6>

            </div>

        </div>


        {{-- Message de succès --}}
        @if(session('success'))

            <div class="alert alert-success">

                <i class="fa-solid fa-circle-check"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- Erreurs --}}
        @if($errors->any())

            <div class="alert alert-danger">

                <strong>Veuillez corriger les erreurs suivantes :</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form method="POST"
              action="{{ route('consommation.store') }}">

            @csrf


            {{-- Sélection du mois --}}
            {{-- Sélection de l'année et du mois --}}
            <div class="mois-container">

                {{-- Année --}}
                <div class="mb-3">

                    <label for="annee">
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

                        @for($annee = 2030; $annee >= 2020; $annee--)

                            <option value="{{ $annee }}"
                                {{ old('annee', date('Y')) == $annee ? 'selected' : '' }}>

                                {{ $annee }}

                            </option>

                        @endfor

                    </select>

                </div>


                {{-- Mois --}}
                <div>

                    <label for="idmois">
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

                            <option value="{{ $m->id }}"
                                {{ old('idmois') == $m->id ? 'selected' : '' }}>

                                {{ $m->nom }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>




            {{-- Tableau --}}
            <div class="consommation-table-container">

                <div class="table-responsive">

                    <table class="table consommation-table">

                        <thead>

                            <tr>

                                <th scope="col">
                                    Utilisateur
                                </th>

                                <th scope="col">
                                    Consommation
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($utilisateurs as $utilisateur)

                                <tr>

                                    <td>
                                        {{ $utilisateur->nom }}
                                    </td>

                                    <td>

                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="consommations[{{ $utilisateur->id }}]"
                                            value="{{ old('consommations.' . $utilisateur->id) }}"
                                            class="form-control consommation-input"
                                            placeholder="0.00"
                                            required
                                        >

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Bouton --}}
            <div class="save-container">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Enregistrer les consommations

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
