@extends('layouts.app')

@section('title', 'Mois')

@section('content')

    <h1>Liste des mois</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mois</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($mois as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->nom }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection