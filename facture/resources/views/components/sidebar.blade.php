<div class="sidebar">

    <h2>Facture</h2>

    <ul class="sidebar-menu">

        {{-- Dashboard --}}
        <li>
            <a href="{{ url('/dashboard') }}"
               class="{{ request()->is('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>


        {{-- Utilisateurs --}}
        <li>
            <a href="{{ url('/utilisateur') }}"
               class="{{ request()->is('utilisateur*') ? 'active' : '' }}">
                Utilisateurs
            </a>
        </li>


        {{-- Consommations --}}
        <li>
            <a href="{{ route('consommation.create') }}"
               class="{{ request()->is('consommation/create') ? 'active' : '' }}">
                Consommations
            </a>
        </li>


        {{-- Déconnexion --}}
        <li>
            <form method="POST" action="{{ url('/logout') }}">

                @csrf

                <button type="submit">
                    Déconnexion
                </button>

            </form>
        </li>

    </ul>

</div>

<style>
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        height: 100vh;
        background: #110c3a;
        color: white;
        padding: 20px;
    }

    .sidebar h2 {
        margin-bottom: 30px;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
    }

    .sidebar-menu li {
        margin-bottom: 8px;
    }

    .sidebar-menu a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 12px 15px;
        border-radius: 6px;
    }

    .sidebar-menu a.active {
        background: #4f46e5;
        color: white;
    }

    .sidebar-menu a:hover {
        background: #312b66;
    }

    .sidebar-menu button {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 12px 15px;
        font-size: 16px;
    }

    .content {
        margin-left: 290px;
        padding: 30px;
    }
</style>