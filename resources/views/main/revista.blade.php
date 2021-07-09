@extends('main.app',['activePage'=>'revista','titlePage' => __('Revista FG')])
@section('content')
    <div class="content shadow">
        <div class="row main">
            <div class="col-md-12 cat">
                <h3 class="titulo-azul">Categorias</h3>
            </div>
        </div>
        <div class="row main">
            @foreach ($cat as $item)
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="hover hover-3 text-white rounded">
                        <img src="{{ asset('images/categorias/' . $item->img_categorias) }}" alt="">
                        <div class="hover-overlay"></div>
                        <div class="hover-3-content px-5 py-4">
                            <h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
                                <strong>{{ $item->nombre }}</strong>
                            </h3>
                            <p class="hover-3-description small text-uppercase mb-0">{{ $item->descripcion }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row main icons">
            <div class="col">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">filter_list</i>
                            <p class="d-lg-none d-md-block">
                                {{ __('Account') }}
                            </p>
                        </a>
                        <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdownProfile">
                            @foreach ($ediciones as $item)
                                <a class="dropdown-item"
                                    href="{{ route('ediciones.show', $item->nombre) }}">{{ $item->nombre }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col">
                <form class="navbar-form">
                    <div class="input-group no-border">
                        <input type="text" value="" class="form-control" placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row main edicion-name">
            <div class="col-md-12">
                @foreach ($nombreEdicion as $item)
                    <h3 class="titulo-azul">Edición: {{ $item->nombre }}</h3>
                @endforeach
            </div>
        </div>
        <div class="row main">
            <div class="col-md-10 main">
                <div class="row cards">
                    <div class="col-md-6">
                        <div class="card">
                            @if (sizeof($posts_row_one) == 0)
                                <p>No hay articulos para mostar</p>
                            @else
                                @foreach ($posts_row_one as $item)
                                    <div class="doc">
                                        <div class="box">
                                            <div class="hovereffect">
                                                <img class="card-img-top img-responsive"
                                                    src="{{ asset('images/' . $item->img_abstract) }}" alt="Card image">
                                                <div class="overlay">
                                                    <h2>{{ Illuminate\Support\Str::of($item->nombre)->words(20) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        <p class="card-text">{!! $item->descripcion !!}</p>
                                        <a href="{{ route('revista.show', $item->post_id) }}"
                                            class="btn read-more text-lowercase">Leer
                                            más...</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            @if (sizeof($flash) == 0)
                                <p>No hay flash para mostar</p>
                            @else
                                @foreach ($flash as $item)
                                    <div class="doc">
                                        <div class="box">
                                            <div class="hovereffect">
                                                <img class="card-img-top"
                                                    src="{{ asset('images/' . $item->img_portada) }}" alt="Card image">
                                                <div class="overlay">
                                                    <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        <div>{!! Illuminate\Support\Str::of($item->cuerpo)->words(30) !!}</div>
                                        <a href="{{ route('revista.show', $item->id) }}"
                                            class="btn read-more text-lowercase">
                                            Leer más...
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row cards">
                    <div class="col-md-4">
                        <div class="card">
                            @foreach ($posts_row_two as $item)
                                <div class="doc">
                                    <div class="box-2">
                                        <div class="hovereffect">
                                            <img class="card-img-top" src="{{ asset('images/' . $item->img_abstract) }}"
                                                alt="Card image">
                                            <div class="overlay">
                                                <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body gray">
                                    </h4>
                                    {!! $item->descripcion !!}
                                    <a href="{{ route('revista.show', $item->id) }}"
                                        class="btn read-more text-lowercase">Leer
                                        más...</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            @foreach ($posts_row_three as $item)
                                <div class="doc">
                                    <div class="box-1">
                                        <div class="hovereffect">
                                            <img class="card-img-top" src="{{ asset('images/' . $item->img_abstract) }}"
                                                alt="Card image">
                                            <div class="overlay">
                                                <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body gray">
                                    {!! $item->descripcion !!}
                                    <a href="{{ route('revista.show', $item->id) }}"
                                        class="btn read-more text-lowercase">
                                        Leer más...
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row cards">
                    <div class="col-md-8">
                        <div class="card">
                            @foreach ($art as $item)
                                <div class="doc">
                                    <div class="box-1">
                                        <div class="hovereffect">
                                            <img class="card-img-top" src="{{ asset('images/' . $item->img_abstract) }}"
                                                alt="Card image">
                                            <div class="overlay">
                                                <h2>{{ Illuminate\Support\Str::of($item->nombre)->words(20) }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body gray">
                                    {!! $item->descripcion !!}
                                    <a href="{{ route('revista.show', $item->id) }}"
                                        class="btn read-more text-lowercase">Leer
                                        más...</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="doc">
                                <div class="box-2">
                                    <div class="hovereffect">
                                        <img class="card-img-top" src="{{ asset('images/' . $item->img_abstract) }}"
                                            alt="Card image">
                                        <div class="overlay">
                                            <h2>{{ Illuminate\Support\Str::of($item->nombre)->words(13) }}</h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body gray">
                                @foreach ($art as $item)
                                    {!! $item->descripcion !!}
                                @endforeach
                                <a href="{{ route('revista.show', $item->id) }}"
                                    class="btn read-more text-lowercase">Leer
                                    más...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 aside index">
                <div class="row">
                    <div class="col">
                        <h5 class="aside titulo-azul">Capsulas</h5>
                        @foreach ($capsulas as $item)
                            <div class="card aside">
                                <img class="card-img-top aside" src="{{ asset('images/' . $item->img_capsula) }}"
                                    alt="Card image">
                                <div class="card-body gray aside">
                                    <h4 class="card-title">{{ $item->nombre }}</h4>
                                    <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(13) !!}</div>
                                </div>
                            </div>
                            <hr>
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
                <hr>
                <div class="row">
                    <div class="col">
                        <h5>Comentarios</h5>
                    </div>
                </div>
                <hr>
                <div class="row" style="padding: 1em">
                    <img class="img-fluid"src="{{asset('images/publicidad/publicidad.png')}}" alt="profile Pic">
                </div>
            </div>
        </div>
        <div class="row main">
            <div class="col-md-12">
                <h3>Ultimas Publicaciones</h3>
            </div>
            @foreach ($pub_rel as $item)
                <div class="col-md-4">
                    <div class="card relacionadas">
                        <div class="doc">
                            <div class="box-2">
                                <img class="card-img-top" src="{{ asset('images/' . $item->img_abstract) }}"
                                    alt="Card image">
                            </div>
                        </div>
                        <div class="card-body gray gray">
                            <h4 class="card-title">{{ Illuminate\Support\Str::of($item->nombre)->words(20) }}</h4>
                            <p class="card-text">{!! Illuminate\Support\Str::of($item->descripcion)->words(30) !!}</p>
                            <a href="{{ route('revista.show', $item->id) }}" class="btn read-more text-lowercase">Leer
                                más...</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row suscribe">
            <div class="col-3"></div>
            <div class="col-6">
                <h3 class="titulo-azul text-center">Boletín informativo</h3>
                <hr>
                <p class="text-center">Suscribete para recibir antes que nadie las nuevas publicaciones</p>
                @include('flash-message')
                <form method="POST" action="{{ route('suscribe.store') }}">
                    @csrf
                    @method('post')
                    <div class="form-row align-items-center" style="text-align: center;">
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInput">Name</label>
                            <input type="text" class="form-control mb-2 form-mail" name="email" id="email"
                                placeholder="Correo Electronico">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn suscribe mb-2">Suscribirse</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous">
    </script>
@endsection


{{-- <div class="row">
    <div class="col-lg-4 col-md-12 mb-4">
      <div class="card">
        <div class="bg-image hover-overlay ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light" style="min-width: 696px;">
          <img src="https://mdbootstrap.com/img/new/standard/nature/002.jpg" class="img-fluid">
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body">
          <h5 class="card-title">Post title</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the
            card's content.
          </p>
          <a href="#!" class="btn btn-primary">Read</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card">
        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
          <img src="https://mdbootstrap.com/img/new/standard/nature/022.jpg" class="img-fluid">
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body">
          <h5 class="card-title">Post title</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the
            card's content.
          </p>
          <a href="#!" class="btn btn-primary">Read</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card">
        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
          <img src="https://mdbootstrap.com/img/new/standard/nature/035.jpg" class="img-fluid">
          <a href="#!">
            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
          </a>
        </div>
        <div class="card-body">
          <h5 class="card-title">Post title</h5>
          <p class="card-text">
            Some quick example text to build on the card title and make up the bulk of the
            card's content.
          </p>
          <a href="#!" class="btn btn-primary">Read</a>
        </div>
      </div>
    </div>
  </div> --}}
