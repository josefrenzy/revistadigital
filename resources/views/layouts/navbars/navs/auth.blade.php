<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <div class="navbar-wrapper">

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Stats') }}
                        </p>
                    </a>
                </li>
                @auth()
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
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
            </ul>
        </div>
    </div>
</nav>
