<header class="box-shadow">
    <nav class="navbar navbar-expand-sm">
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
                    <a class="nav-link text-uppercase gray" href="https://floresgaribay.mx/">Inicio <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="http://floresgaribay.mx/#nosotros">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase gray"
                        href="http://floresgaribay.mx/consultoria-fiscal/">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="http://floresgaribay.mx/contacto/">Contacto</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="material-icons">fingerprint</i> {{ __('Login') }}
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-uppercase gray" href="#">{{auth()->user()->name}}</a>
                </li> --}}
            </ul>
        </div>
    </nav>
</header>
