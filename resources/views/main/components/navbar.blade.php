<header class="box-shadow">
    <nav class="navbar navbar-expand-sm fixed-top ">
        <a href="https://floresgaribay.mx/">
            <img src="{{ url('/images/utils/nav.png') }}" alt="Navbar" class="img-nav">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mr-auto float-right" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link main text-uppercase gray" href="https://floresgaribay.mx/">Inicio <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main text-uppercase gray" href="http://floresgaribay.mx/#nosotros">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main text-uppercase gray"
                        href="http://floresgaribay.mx/consultoria-fiscal/">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main text-uppercase gray" href="http://floresgaribay.mx/contacto/">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link main text-uppercase gray" href="{{ url('revista') }}">Revista FG</a>
                </li>
                @auth()
                    <li class="nav-item dropdown">
                        <a class="nav-link main" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>
                            <p class="d-lg-none d-md-block">
                                {{ __('Account') }}
                            </p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            @if (auth()->user()->type == 2)
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
                            @endif
                            @if (auth()->user()->type == 1)
                            <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                            <div class="dropdown-divider"></div> 
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
                            @endif
                            @if (auth()->user()->type == 0)
                                <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                <div class="dropdown-divider"></div> 
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Salir') }}</a>
                            @endif
                        </div>
                    </li>
                @endauth
                @guest()
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="material-icons">fingerprint</i> {{ __('Login') }}
                        </a>
                    </li>
                @endguest

            </ul>
        </div>
    </nav>
</header>
