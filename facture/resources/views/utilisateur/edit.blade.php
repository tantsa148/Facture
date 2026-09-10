@extends('layouts.app')

@section('title', 'Modifier un utilisateur')

@section('content')

<h1>Modifier l'utilisateur</h1>

<form
    method="POST"
    action="{{ route('utilisateur.update', $utilisateur->id) }}"
>


@csrf
@method('PUT')

<label for="nom">
    Nom
</label>

<input
    type="text"
    id="nom"
    name="nom"
    value="{{ old('nom', $utilisateur->nom) }}"
>

<button type="submit">
    Modifier
</button>

</form>

@endsection
