@extends('main.app',['activePage'=>'revista','titlePage' => __('Revista FG')])
@section('content')
    <div class="content shadow">
        <div class="row main">
            <div class="col-md-12 cat">
                <h3 class="titulo-azul">Categorias</h3>
            </div>
        </div>
        {{-- Barra donde se colocan las categorias --}}
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
                {{-- fila 1 --}}
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
                                                    <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        {!! Illuminate\Support\Str::of($item->descripcion)->words(25) !!}
                                        <br>
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
                            @if (sizeof($flash_row_one) == 0)
                                <p>No hay flash para mostar</p>
                            @else
                                @foreach ($flash_row_one as $item)
                                    <div class="doc">
                                        <div class="box">
                                            <div class="hovereffect">
                                                <img class="card-img-top"
                                                    src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                    alt="Card image">
                                                <div class="overlay">
                                                    <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        {!! Illuminate\Support\Str::of($item->cuerpo)->words(30) !!}
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
                </div>
                {{-- Fila 2 --}}
                <div class="row cards">
                    <div class="col-md-4">
                        <div class="card">
                            @if (sizeof($posts_row_two) == 0)
                                <p>No hay articulos para mostar</p>
                            @else
                                @foreach ($posts_row_two as $item)
                                    <div class="doc">
                                        <div class="box-2">
                                            <div class="hovereffect">
                                                <img class="card-img-top"
                                                    src="{{ asset('images/' . $item->img_abstract) }}" alt="Card image">
                                                <div class="overlay">
                                                    <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        </h4>
                                        {!! Illuminate\Support\Str::of($item->descripcion)->words(17) !!}
                                        <br>
                                        <a href="{{ route('revista.show', $item->post_id) }}"
                                            class="btn read-more text-lowercase">Leer
                                            más...</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            @if (sizeof($flash_row_two) == 0)
                                <p>No hay articulos para mostar</p>
                            @else
                                @foreach ($flash_row_two as $item)
                                    <div class="doc">
                                        <div class="box-1">
                                            <div class="hovereffect">
                                                <img class="card-img-top"
                                                    src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                    alt="Card image">
                                                <div class="overlay">
                                                    <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        {!! Illuminate\Support\Str::of($item->cuerpo)->words(25) !!}
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
                </div>
                {{-- Fila 3 --}}
                <div class="row cards">
                    <div class="col-md-8">
                        <div class="card">
                            @if (sizeof($posts_row_three) == 0)
                                <p>No hay articulos para mostar</p>
                            @else
                                @foreach ($posts_row_three as $item)
                                    <div class="doc">
                                        <div class="box-1">
                                            <div class="hovereffect">
                                                <img class="card-img-top"
                                                    src="{{ asset('images/' . $item->img_abstract) }}" alt="Card image">
                                                <div class="overlay">
                                                    <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(20) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray"> 
                                        {!! Illuminate\Support\Str::of($item->descripcion)->words(30) !!}
                                        <div><br></div>
                                        <a href="{{ route('revista.show', $item->post_id) }}"
                                            class="btn read-more text-lowercase">Leer
                                            más...</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            @if (sizeof($flash_row_three) == 0)
                                <p>No hay articulos para mostar</p>
                            @else
                                @foreach ($flash_row_three as $item)
                                    <div class="doc">
                                        <div class="box-2">
                                            <div class="hovereffect">
                                                <img class="card-img-top"
                                                    src="{{ asset('images/flash/' . $item->img_portada) }}"
                                                    alt="Card image">
                                                <div class="overlay">
                                                    <h2>{{ Illuminate\Support\Str::of($item->titulo)->words(13) }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body gray">
                                        {!! Illuminate\Support\Str::of($item->cuerpo)->words(17) !!}
                                        <br>
                                        <a href="{{ route('flash.show', $item->id) }}"
                                            class="btn read-more text-lowercase">Leer
                                            más...</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
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
        @include('main.components.suscribe')
    </div>
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous">
    </script>
@endsection
