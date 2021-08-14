@extends('main.app',['activePage'=>'revista','titlePage' => __('Revista FG')])
@section('content')
    <div class="content shadow">
        <div class="row main">
            <div class="col-md-12 cat">
                @foreach ($nombreEdicion as $item)
                    @if ($item->status == 1)
                        <h3 class="titulo-azul">Edición: {{ $item->nombre }}</h3>
                    @else
                        <h3 class="titulo-azul">Edición: Inactiva</h3>
                    @endif
                @endforeach
            </div>
        </div>
        {{-- Barra donde se colocan las categorias --}}
        <div class="row main">
            @foreach ($cat as $item)
                @if ($item->status == 1)
                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="hover hover-3 text-white rounded">
                            <div class="img-contenedor-categoria">
                                <img class="img-categoria" src="{{ asset('images/categorias/' . $item->img_categorias) }}"
                                    alt="">
                                <div class="hover-overlay"></div>
                            </div>
                            <div class="hover-3-content px-5 py-4">
                                <h3 class="hover-3-title text-uppercase font-weight-bold mb-1">
                                    <a href="{{ route('categories.show', $item->nombre) }}"
                                        style="color: white !important"><strong>{{ $item->nombre }}</strong></a>
                                </h3>
                                <p class="hover-3-description small text-uppercase mb-0">{{ $item->descripcion }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="row justify-content-center last-posts" style="background-color: white">
            <div class="col-lg-1">
                <span>{{ $cat->links() }}</span>
            </div>
        </div>
        {{-- Filas Ediciones y search_bar --}}
        <div class="row main icons">
            {{-- barra de busqueda --}}
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
                                @if ($item->status == 1)
                                    <a class="dropdown-item"
                                        href="{{ route('ediciones.show', $item->nombre) }}">{{ $item->nombre }}</a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col">
                <form class="navbar-form" action="{{ route('search') }}" method="GET">
                    <div class="input-group no-border">
                        <input type="text" name="search" class="form-control" placeholder="Search..." required>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row main">
            <div class="col-md-10 main">
                {{-- fila 1 --}}
                <div class="row cards">
                    @if (sizeof($posts_row_one) == 0 || sizeof($flash_row_one) == 0)
                        @if (sizeof($posts_row_one) == 0)
                            <div class="col-md-12">
                                <div class="card">
                                    @foreach ($flash_row_one as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-2">
                                                <div class="hovereffect">
                                                    <img class="img-fila-tres-solo"
                                                        src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                        alt="Card image">
                                                    <div class="overlay">
                                                        <a href="{{ route('flash.show', $item->id) }}">
                                                            <h2><strong>{{ Illuminate\Support\Str::of($item->titulo)->words(13) }}</strong></h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->cuerpo)->words(55) !!}</div>
                                            <br>
                                            <a href="{{ route('flash.show', $item->id) }}"
                                                class="btn read-more text-lowercase">Leer
                                                más...</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (sizeof($flash_row_one) == 0)
                            <div class="col-md-12">
                                <div class="card">
                                    @foreach ($posts_row_one as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-2">
                                                <div class="hovereffect">
                                                    <img class="img-fila-tres-solo"
                                                        src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                                        alt="Card image">
                                                    <div class="overlay">
                                                        <a href="{{ route('revista.show', $item->post_id) }}">
                                                            <h2><strong>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</strong></h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(55) !!}</div>
                                            <br>
                                            <a href="{{ route('revista.show', $item->post_id) }}"
                                                class="btn read-more text-lowercase">Leer
                                                más...</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-6">
                            <div class="card">
                                @foreach ($posts_row_one as $item)
                                    <div class="img-contenedor-fila-uno">
                                        <div class="box">
                                            <div class="hovereffect">
                                                <img class="img-fila-uno"
                                                    src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                                    alt="Card image">
                                                <div class="overlay-2">
                                                    <a href="{{ route('revista.show', $item->post_id) }}">
                                                        <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(30) !!}</div>
                                        <br>
                                        <a href="{{ route('revista.show', $item->post_id) }}"
                                            class="btn read-more text-lowercase">Leer
                                            más...</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                @foreach ($flash_row_one as $item)
                                    <div class="img-contenedor-fila-uno">
                                        <div class="box">
                                            <div class="hovereffect">
                                                <img class="img-fila-uno"
                                                    src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                    alt="Card image">
                                                <div class="overlay-2">
                                                    <a href="{{ route('flash.show', $item->id) }}">
                                                        <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        <div>{!! Illuminate\Support\Str::of($item->cuerpo)->words(30) !!}</div>
                                        <br>
                                        <a href="{{ route('flash.show', $item->id) }}"
                                            class="btn read-more text-lowercase">
                                            Leer más...
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                {{-- Fila 2 --}}
                <div class="row cards">
                    @if (sizeof($posts_row_two) == 0 || sizeof($flash_row_two) == 0)
                        @if (sizeof($posts_row_two) == 0)
                            <div class="col-md-12">
                                <div class="card">
                                    @foreach ($flash_row_two as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-2">
                                                <div class="hovereffect">
                                                    <img class="img-fila-tres-solo"
                                                        src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                        alt="Card image">
                                                    <div class="overlay">
                                                        <a href="{{ route('flash.show', $item->id) }}">
                                                            <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(13) }}</h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->cuerpo)->words(55) !!}</div>
                                            <br>
                                            <a href="{{ route('flash.show', $item->id) }}" class="btn read-more text-lowercase">Leer más...</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (sizeof($flash_row_two) == 0)
                            <div class="col-md-12">
                                <div class="card">
                                    @foreach ($posts_row_two as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-2">
                                                <div class="hovereffect">
                                                    <img class="img-fila-tres-solo"
                                                        src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                                        alt="Card image">
                                                    <div class="overlay">
                                                        <a href="{{ route('revista.show', $item->post_id) }}">
                                                            <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(55) !!}</div>
                                            <br>
                                            <a href="{{ route('revista.show', $item->post_id) }}"
                                                class="btn read-more text-lowercase">Leer
                                                más...</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-4">
                            <div class="card">
                                @foreach ($posts_row_two as $item)
                                    <div class="img-contenedor-fila-dos">
                                        <div class="box-2">
                                            <div class="hovereffect">
                                                <img class="img-fila-dos"
                                                    src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                                    alt="Card image">
                                                <div class="overlay-3">
                                                    <a href="{{ route('revista.show', $item->post_id) }}">
                                                        <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(17) !!}</div>
                                        <br>
                                        <a href="{{ route('revista.show', $item->post_id) }}"
                                            class="btn read-more text-lowercase">Leer
                                            más...</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                @if (sizeof($flash_row_two) == 0)
                                    <p>no hay flash para mostrar</p>
                                @else
                                    @foreach ($flash_row_two as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-1">
                                                <div class="hovereffect">
                                                    <img class="img-fila-dos"
                                                        src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                        alt="Card image">
                                                    <div class="overlay">
                                                        <a href="{{ route('flash.show', $item->id) }}">
                                                            <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->cuerpo)->words(35) !!}</div>
                                            <br>
                                            <a href="{{ route('flash.show', $item->id) }}"
                                                class="btn read-more text-lowercase">
                                                Leer más...
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                {{-- Fila 3 --}}
                <div class="row cards">
                    @if (sizeof($posts_row_three) == 0 || sizeof($flash_row_three) == 0)
                        @if (sizeof($posts_row_three) == 0)
                            <div class="col-md-12">
                                <div class="card">
                                    @foreach ($flash_row_three as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-2">
                                                <div class="hovereffect">
                                                    <img class="img-fila-tres-solo"
                                                        src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                        alt="Card image">
                                                    <div class="overlay">
                                                        <a href="{{ route('flash.show', $item->id) }}">
                                                            <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(13) }}</h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->cuerpo)->words(55) !!}</div>
                                            <br>
                                            <a href="{{ route('flash.show', $item->id) }}"
                                                class="btn read-more text-lowercase">Leer
                                                más...</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (sizeof($flash_row_three) == 0)
                            <div class="col-md-12">
                                <div class="card">
                                    @foreach ($posts_row_three as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-2">
                                                <div class="hovereffect">
                                                    <img class="img-fila-tres-solo"
                                                        src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                                        alt="Card image">
                                                    <div class="overlay">
                                                        <a href="{{ route('revista.show', $item->post_id) }}">
                                                            <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(55) !!}</div>
                                            <br>
                                            <a href="{{ route('revista.show', $item->post_id) }}"
                                                class="btn read-more text-lowercase">Leer
                                                más...</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-8">
                            <div class="card">
                                @foreach ($posts_row_three as $item)
                                    <div class="img-contenedor-fila-tres">
                                        <div class="box-1">
                                            <div class="hovereffect">
                                                <img class="img-fila-tres"
                                                    src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                                    alt="Card image">
                                                <div class="overlay">
                                                    <a href="{{ route('revista.show', $item->post_id) }}">
                                                        <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(35) !!}</div>
                                        <div><br></div>
                                        <a href="{{ route('revista.show', $item->post_id) }}"
                                            class="btn read-more text-lowercase">Leer
                                            más...</a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                @if (sizeof($flash_row_three) == 0)
                                    <p>No hay Flash para mostar</p>
                                @else
                                    @foreach ($flash_row_three as $item)
                                        <div class="img-contenedor-fila-tres">
                                            <div class="box-2">
                                                <div class="hovereffect">
                                                    <img class="img-fila-tres"
                                                        src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                        alt="Card image">
                                                    <div class="overlay-3">
                                                        <a href="{{ route('flash.show', $item->id) }}">
                                                            <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(13) }}</h2>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body gray">
                                            <div>{!! Illuminate\Support\Str::of($item->cuerpo)->words(17) !!}</div>
                                            <br>
                                            <a href="{{ route('flash.show', $item->id) }}"
                                                class="btn read-more text-lowercase">Leer
                                                más...</a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- Barra lateral --}}
            @include('main.components.aside')
        </div>
        {{-- fila de abajo --}}
        <div class="row main">
            <div class="col-md-12">
                <h3>Ultimas Publicaciones</h3>
            </div>
            @foreach ($ultimas_publicaciones as $item)
                <div class="col-md-4">
                    <div class="card relacionadas">
                        <div class="img-contenedor-ultimas-pub">
                            <div class="box-2-2">
                                <img class="img-ultimas-pub" src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                    alt="Card image">
                            </div>
                        </div>
                        <div class="card-body gray gray">
                            <h4 class="card-title text-uppercase"><strong>{{ Illuminate\Support\Str::of($item->titulo)->words(15) }}</strong></h4>
                            <p class="card-text">{!! Illuminate\Support\Str::of($item->descripcion)->words(25) !!}</p>
                            <a href="{{ route('revista.show', $item->id) }}" class="btn read-more text-lowercase">Leer
                                más...</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center last-posts" style="background-color: white">
            <div class="col-lg-1">
                <span>{{ $ultimas_publicaciones->links() }}</span>
            </div>
        </div>
        @include('main.components.suscribe')
    </div>
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous">
    </script>
@endsection
