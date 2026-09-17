@extends('layouts.guest')

@section('title', 'Créer un compte')

@section('content')

<style>
    .register-page {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px 20px;
    }

    .register-card {
        width: 100%;
        max-width: 450px;
        border: none;
        border-radius: 10px;
    }

    .register-card .card-body {
        padding: 35px;
    }

    .register-icon {
        text-align: center;
        margin-bottom: 20px;
    }

    .register-icon i {
        font-size: 45px;
        color: #4f46e5;
    }

    .register-title {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .register-subtitle {
        text-align: center;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .form-group label {
        font-weight: 500;
    }

    .input-group-text {
        background: #f8f9fa;
    }

    .register-button {
        width: 100%;
        margin-top: 10px;
        padding: 10px;
    }
</style>


<div class="register-page">

    <div class="card shadow-sm register-card">

        <div class="card-body">

            {{-- Icône --}}
            <div class="register-icon">

                <i class="fa-solid fa-user-plus"></i>

            </div>


            {{-- Titre --}}
            <h3 class="register-title">
                Créer un compte
            </h3>

            <p class="register-subtitle">
                Créez votre compte pour accéder à l'application
            </p>


            {{-- Message de succès --}}
            @if(session('success'))

                <div class="alert alert-success">

                    <i class="fa-solid fa-circle-check"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- Erreurs générales --}}
            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Veuillez corriger les erreurs :
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Formulaire --}}
            <form method="POST"
                  action="{{ url('/users') }}">

                @csrf


                {{-- Nom --}}
                <div class="form-group">

                    <label for="name">
                        Nom
                    </label>

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>

                        </div>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control"
                            placeholder="Entrez votre nom"
                            required
                        >

                    </div>

                    @error('name')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- Email --}}
                <div class="form-group">

                    <label for="email">
                        Email
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
                        >

                    </div>

                    @error('email')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

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

                    @error('password')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- Confirmation --}}
                <div class="form-group">

                    <label for="password_confirmation">
                        Confirmer le mot de passe
                    </label>

                    <div class="input-group">

                        <div class="input-group-prepend">

                            <span class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </span>

                        </div>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirmez votre mot de passe"
                            required
                        >

                    </div>

                    @error('password_confirmation')

                        <small class="text-danger">
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- Bouton --}}
                <button type="submit"
                        class="btn btn-primary register-button">

                    <i class="fa-solid fa-user-plus"></i>

                    Créer le compte

                </button>

            </form>

        </div>

    </div>

</div>

@endsection

