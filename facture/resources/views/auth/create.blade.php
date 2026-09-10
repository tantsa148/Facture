<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Créer un compte</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            width: 400px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .errors {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .errors ul {
            margin: 5px 0 0 20px;
            padding: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .field-error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Créer un compte</h1>

    {{-- Message de succès --}}
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Erreurs générales --}}
    @if ($errors->any())
        <div class="errors">
            <strong>Veuillez corriger les erreurs :</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire --}}
    <form method="POST" action="/users">

        @csrf

        {{-- Nom --}}
        <div class="form-group">
            <label for="name">Nom</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Entrez votre nom"
            >

            @error('name')
                <div class="field-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Entrez votre email"
            >

            @error('email')
                <div class="field-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div class="form-group">
            <label for="password">Mot de passe</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Entrez votre mot de passe"
            >

            @error('password')
                <div class="field-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Confirmation --}}
        <div class="form-group">
            <label for="password_confirmation">
                Confirmer le mot de passe
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="Confirmez votre mot de passe"
            >

            @error('password_confirmation')
                <div class="field-error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit">
            Créer le compte
        </button>

    </form>

</div>

</body>
</html>
