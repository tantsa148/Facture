@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')

<style>
    /* Carte principale */
    .users-card {
        width: 90%;
        margin: 20px auto;
    }

    /* Titre */
    .users-card .card-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .users-card .card-subtitle {
        color: #6c757d;
        font-weight: 400;
    }

    /* Bouton Ajouter */
    .add-user {
        width: 85%;
        margin: 0 auto 20px auto;
        display: flex;
        justify-content: flex-end;
    }
    /* Conteneur du tableau */
    .users-table-container {
        width: 85%;
        margin: 0 auto;
    }

    /* Tableau */
    .users-table {
        width: 100%;
        text-align: left;
    }

    .users-table th {
        font-weight: 600;
    }

    .users-table td,
    .users-table th {
        vertical-align: middle;
        padding: 12px 15px;
    }

    .header-users {
    width: 85%;
    margin: 0 auto 10px auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

    .header-users .card-title {
        margin-bottom: 5px;
    }

    .header-users .card-subtitle {
        margin-bottom: 0;
    }

    /* Colonne ID */
    .users-table th:first-child {
        width: 10%;
    }

    /* Colonne Nom */
    .users-table td:nth-child(2) {
        width: 50%;
    }

    /* Colonne Actions */
    .users-table td:last-child {
        width: 40%;
    }

    /* Boutons avec icônes */
    .action-btn {
        width: 35px;
        height: 35px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 5px;
    }

    /* Formulaire suppression */
    .delete-form {
        display: inline;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .users-card {
            width: 100%;
            margin: 10px auto;
        }

        .users-table-container {
            width: 100%;
        }

    }
</style>


<div class="card users-card">

    <div class="card-body">

       <div class="header-users">

            <div>
                <h4 class="card-title">
                    Liste des utilisateurs
                </h4>

                <h6 class="card-subtitle">
                    Gestion des utilisateurs enregistrés dans l'application.
                </h6>
            </div>

            <button type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#ajouterUtilisateurModal">

                <i class="fa-solid fa-plus"></i>
                Ajouter un utilisateur

            </button>
        </div>

        <br>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="users-table-container">

            <div class="table-responsive">

                <table class="table users-table">

                    <thead>
                        <tr>

                            <th scope="col">
                                #
                            </th>

                            <th scope="col">
                                Nom
                            </th>

                            <th scope="col">
                                Actions
                            </th>

                        </tr>
                    </thead>


                    <tbody>

                        @foreach($utilisateurs as $utilisateur)

                            <tr>

                                <th scope="row">
                                    {{ $utilisateur->id }}
                                </th>

                                <td>
                                    {{ $utilisateur->nom }}
                                </td>


                                <td>

                                    {{-- Voir --}}
                                    <button type="button"
                                            class="btn btn-info btn-sm action-btn"
                                            title="Voir"
                                            data-toggle="modal"
                                            data-target="#voirUtilisateurModal{{ $utilisateur->id }}">

                                        <i class="fa-solid fa-eye"></i>

                                    </button>

                                    {{-- Modifier --}}
                                   <button type="button"
                                            class="btn btn-warning btn-sm action-btn"
                                            title="Modifier"
                                            data-toggle="modal"
                                            data-target="#modifierUtilisateurModal{{ $utilisateur->id }}">

                                        <i class="fa-solid fa-pen"></i>

                                    </button>

                                    {{-- Supprimer --}}
                                    <form
                                        method="POST"
                                        action="{{ route('utilisateur.destroy', $utilisateur->id) }}"
                                        class="delete-form"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm action-btn"
                                            title="Supprimer"
                                            onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>
                        
                        @include('utilisateur.show-modal')
                        @include('utilisateur.edit-modal')
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@include('utilisateur.create-modal')
@endsection
