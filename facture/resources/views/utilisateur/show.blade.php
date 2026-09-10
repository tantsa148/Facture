@extends('layouts.app')

@section('title', 'Utilisateur')

@section('content')

<h1>Détails de l'utilisateur</h1>

<p>
    <strong>ID :</strong>
    {{ $utilisateur->id }}
</p>

<p>
    <strong>Nom :</strong>
    {{ $utilisateur->nom }}
</p>

<a href="{{ route('utilisateur.index') }}">
    Retour
</a>

@endsection
