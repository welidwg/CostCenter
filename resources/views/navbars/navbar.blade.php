<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    @if (Auth::user()->role == 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Management
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.index') }}">Users</a></li>
                                <li><a class="dropdown-item" href="{{ route('departement.index') }}">Departements</a>
                                </li>
                                {{-- <li><a class="dropdown-item" href="#">Sites</a></li> --}}
                                <li><a class="dropdown-item" href="{{ route('article.index') }}">Articles</a></li>
                                {{-- <li><a class="dropdown-item" href="#">Cycles de production</a></li> --}}
                                <li><a class="dropdown-item" href="{{ route('demandeur.index') }}">Demandeurs
                                        d'achats</a></li>

                            </ul>
                        </li>
                    @endif
                </ul>
                @auth
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="text-dark">
                            {{ Auth::user()->login }} | {{ Auth::user()->role == 1 ? 'Admin' : 'User' }}&nbsp;
                        </div>
                        <a href="/logout" class="btn btn-danger">Logout</a>
                    </div>
                @endauth
                @if (Auth::check())
                @endif


            </div>
        </div>
    </nav>
</header>
