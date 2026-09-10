<div class="sidebar">
    <h2>Mon Application</h2>


<ul class="sidebar-menu">
    <li>
        <a href="{{ url('/dashboard') }}">
            Dashboard
        </a>
    </li>

    <li>
        <a href="{{ url('/utilisateur') }}">
            Utilisateurs
        </a>
    </li>

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
        background: #222;
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
        margin-bottom: 15px;
    }

    .sidebar-menu a {
        color: white;
        text-decoration: none;
    }

    .sidebar-menu button {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 0;
        font-size: 16px;
    }

    .content {
        margin-left: 290px;
        padding: 30px;
    }
</style>
