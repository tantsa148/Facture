@extends('layouts.app')

@section('title', 'Saisie des consommations')

@section('content')

    <h1>Saisie des consommations</h1>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('consommation.store') }}">

        @csrf

        <div>
            <label for="idmois">Mois :</label>

            <select name="idmois" id="idmois" required>

                <option value="">-- Choisir un mois --</option>

                @foreach($mois as $m)
                    <option value="{{ $m->id }}">
                        {{ $m->nom }}
                    </option>
                @endforeach

            </select>
        </div>

        <br>

        <table border="1">

            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Consommation</th>
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
                                required
                            >
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <br>

        <button type="submit">
            Enregistrer les consommations
        </button>

    </form>

@endsection