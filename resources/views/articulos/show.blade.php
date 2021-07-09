<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset('css/app.css'); ?>" type="text/css">

    <title>Revista Digital</title>
</head>

<body style="padding: 0 5%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;">
    <header class="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        @if (auth()->check())
            <nav class="navbar navbar-expand-sm" style="border-bottom: solid 5px black;
                color:#fff">
                <img src="{{ url('/images/nav.png') }}" alt="Navbar" style="max-width: 20%">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mr-auto float-right" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-uppercase" href="#">Inicio <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#">Revista FG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
    </header>
    <div class="content" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            {{-- <img src="..." alt="..."> --}}
                            <img class="d-block w-100" src="{{ url('/images/row2-2.png') }}" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                              <h1>{{ $post -> titulo }}</h1>
                              {{-- <p>...</p> --}}
                            </div>
                          </div>
                        {{-- <div class="carousel-item active">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12" style="padding: 0 10%">
                        {!! $post->cuerpo !!}
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <div class="col">
                        <h5>Ultimas Publicaciones</h5>
                        @foreach ($capsulas as $item)
                            <div class="card" style="width:190px">
                                <img class="card-img-top" src="{{ asset('images/' . $item->img_capsula) }}"
                                    alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $item->nombre }}</h4>
                                    <p class="card-text">{!! $item->descripcion !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Categorias</h5>
                        @foreach ($categories as $cat)
                            <span class="badge badge-secondary">{{ $cat->nombre }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h5>Comentarios</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Publicaciones Relaconadas</h3>
            </div>
            <div class="col-md-4">
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png"
                        alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">John Doe</h4>
                        <p class="card-text">Some example text.</p>
                        <a href="#" class="btn btn-primary">See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png"
                        alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">John Doe</h4>
                        <p class="card-text">Some example text.</p>
                        <a href="#" class="btn btn-primary">See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="https://www.w3schools.com/bootstrap4/img_avatar1.png"
                        alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">John Doe</h4>
                        <p class="card-text">Some example text.</p>
                        <a href="#" class="btn btn-primary">See Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="color:black">
            <div class="mx-auto text-white" style="width: 200px;">
                Content is in center
            </div>
        </div>
    </div>
    <footer class="page-footer font-small blue pt-4" style="background-color: #083d7d !important; color: #fff">
        <div class="container-fluid text-center text-md-left">
            <div class="row">
                <div class="col-md-3 mb-md-0 mb-3">
                    <img src="{{ url('/images/footer.png') }}" alt="Footer" style="max-width: 90%" />
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">Horario</h5>
                    <p>Lunes a viernes de 9:00 AM a 6:00 PM</p>

                    <h5 class="text-uppercase">EMAIL</h5>
                    <p>contacto@fg.com.mx</p>

                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">Oficinas Guadalajara</h5>
                    <p>
                        Av. de las Rosas #210<br>
                        Colonia Chapalita<br>
                        Guadalajara, Jal, Mex CP: 44510<br>
                        Tel: 33 33 33 33
                    </p>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">OFICINA VALLARTA</h5>
                    <p>
                        Paseo de los cocoteros #85 Sur L-11<br>
                        Centro Comercial Paradise Village Plaza<br>
                        Nuevo Valarta, Nay, Mex CP: 63732<br>
                        Tel: 33 33 33 33, Fax: 44 44 44 44
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center py-3">© 2021 Copyright:
            <a href="https://mdbootstrap.com/"> Aviso de Privacidad</a>
        </div>
    </footer>
    @endif
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src=" https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    @stack('js')
</body>

</html>
