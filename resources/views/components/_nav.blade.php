<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('default.home') }}">ActuNews</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('default.home') }}">Accueil</a></li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('default.category', ['alias' => 'politique']) }}">
                    Politique</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('default.category', ['alias' => 'economie']) }}">
                    Economie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('default.category', ['alias' => 'social']) }}">
                    Social</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact.contact') }}">Contact</a></li>
        </ul>
    </div>
</nav>
