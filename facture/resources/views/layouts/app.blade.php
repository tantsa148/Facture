<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title', 'Mon Application')</title>


</head>

<body>


{{-- Sidebar --}}
@include('components.sidebar')

{{-- Contenu de la page --}}
<main class="content">
    @yield('content')
</main>


</body>
</html>
