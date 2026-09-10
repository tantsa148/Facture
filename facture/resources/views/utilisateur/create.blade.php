@extends('layouts.app')

@section('title', 'Ajouter un utilisateur')

@section('content')

<h1>Ajouter un utilisateur</h1>

@if($errors->any()) <div> <ul>
@foreach($errors->all() as $error) <li>{{ $error }}</li>
@endforeach </ul> </div>
@endif

<form method="POST" action="{{ route('utilisateur.store') }}">

@csrf

<label for="nom">
    Nom
</label>

<input
    type="text"
    id="nom"
    name="nom"
    value="{{ old('nom') }}"
    placeholder="Entrez le nom"
>

<button type="submit">
    Enregistrer
</button>

</form>

@endsection
