@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')

<h1>Utilisateurs</h1>

@if(session('success')) <p>{{ session('success') }}</p>
@endif

<a href="{{ route('utilisateur.create') }}">
    Ajouter un utilisateur
</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>

```
<tbody>

    @foreach($utilisateurs as $utilisateur)

        <tr>
            <td>{{ $utilisateur->id }}</td>

            <td>{{ $utilisateur->nom }}</td>

            <td>

                <a href="{{ route('utilisateur.show', $utilisateur->id) }}">
                    Voir
                </a>

                <a href="{{ route('utilisateur.edit', $utilisateur->id) }}">
                    Modifier
                </a>

                <form
                    method="POST"
                    action="{{ route('utilisateur.destroy', $utilisateur->id) }}"
                    style="display:inline;"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Supprimer
                    </button>
                </form>

            </td>
        </tr>

    @endforeach

</tbody>
```

</table>

@endsection
