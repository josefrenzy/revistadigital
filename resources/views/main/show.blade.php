@extends('main.app',['activePage'=>'index','titlePage' => __('Inicio')])

@section('content')
    <div class="content shadow">
        <div class="row">
            <div class="col-md-12">
                <div class="hover hover-5 text-white rounded">
                    <img src="{{ url('/images/row2-2.png') }}" alt="">
                    <div class="hover-overlay"></div>
                    <div class="hover-5-content">
                        <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
                            <strong class="font-weight-bold text-white">{{ $post[0]->titulo }}</strong>
                            <span>Autor: {{ $post[0]->name }}</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row main">
            <div class="col-md-10 main">
                <div class="row">
                    <div class="col-md-12 cuerpo-articulo">
                        {!! $post[0]->cuerpo !!}
                    </div>
                </div>
            </div>
            <div class="col-md-2 aside">
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
                    <img class="img-fluid" src="{{ asset('images/publicidad/publicidad.png') }}" alt="profile Pic">
                </div>
            </div>
        </div>

        <div class="row main">
            <div class="col-md-12">
                <h3>Publicaciones Relacionadas</h3>
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
@endsection
