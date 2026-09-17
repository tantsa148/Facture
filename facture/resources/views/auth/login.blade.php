@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')

<style>
    .login-page {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        border: none;
        border-radius: 10px;
    }

    .login-card .card-body {
        padding: 35px;
    }

    .login-title {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .login-subtitle {
        text-align: center;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .login-icon {
        text-align: center;
        margin-bottom: 20px;
    }

    .login-icon i {
        font-size: 45px;
        color: #4f46e5;
    }

    .form-group label {
        font-weight: 500;
    }

    .input-group-text {
        background: #f8f9fa;
    }

    .login-button {
        width: 100%;
        margin-top: 10px;
        padding: 10px;
    }
</style>


<div class="login-page">

    <div class="card shadow-sm login-card">

        <div class="card-body">

            {{-- Icône --}}
            <div class="login-icon">

                <i class="fa-solid fa-user-lock"></i>

            </div>


            {{-- Titre --}}
            <h3 class="login-title">
                Connexion
            </h3>

            <p class="login-subtitle">
                Connectez-vous à votre compte
            </p>


            {{-- Erreur --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            {{-- Formulaire --}}
            <form method="POST"
                  action="{{ url('/login') }}">

                @csrf


                {{-- Email --}}
                <div class="form-group">

                    <label for="email">
                        Adresse email
                    </label>

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text">
                                <i class="fa-solid fa-envelope"></i>
                            </span>

                        </div>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                            placeholder="Entrez votre email"
                            required
                            autofocus
                        >

                    </div>

                </div>


                {{-- Mot de passe --}}
                <div class="form-group">

                    <label for="password">
                        Mot de passe
                    </label>

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </span>

                        </div>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Entrez votre mot de passe"
                            required
                        >

                    </div>

                </div>


                {{-- Bouton --}}
                <button type="submit"
                        class="btn btn-primary login-button">

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Se connecter

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
```
