<header class="box-shadow">
    <nav class="navbar navbar-expand-sm">
        <img src="{{ url('/images/nav.png') }}" alt="Navbar" class="img-nav">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mr-auto float-right" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-uppercase gray" href="{{ url('/') }}">Inicio <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="{{ url('nosotros') }}">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="{{ url('servicios') }}">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="{{ url('contacto') }}">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="{{ url('revista') }}">Revista FG</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Account') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                    </div>
                </li>

                {{-- <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}" style="display: none">
                    <a href="{{ route('register') }}" class="nav-link">
                        <i class="material-icons">person_add</i> {{ __('Registro') }}
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}" style="display: none">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="material-icons">fingerprint</i> {{ __('Login') }}
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="#">{{auth()->user()->name}}</a>
                </li> --}}
            </ul>
        </div>
    </nav>
</header>
