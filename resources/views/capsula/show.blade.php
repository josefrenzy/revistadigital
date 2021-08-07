@extends('main.app',['activePage'=>'index','titlePage' => __('Inicio')])

@section('content')
    <div class="content shadow">
        <div class="row main">
            <div class="col-md-10 main">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="img-contenedor-ultimas-pub">
                                <div class="box-2-ediciones">
                                    <img class="img-capsulas"
                                        src="{{ asset('images/capsulas/' . $capsula->img_capsula) }}" alt="Card image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h3 class="card-title text-uppercase"><strong>{{ $capsula->nombre }}</strong></h3>
                                <div>{!! Illuminate\Support\Str::of($capsula->descripcion)->words(50) !!}</div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('main.components.aside')
        </div>

        {{-- <div class="row justify-content-center last-posts" style="background-color: white">
            <div class="col-lg-1">
                <span>{{ $posts->links() }}</span>
            </div>
        </div> --}}
        {{-- <div class="row main" style="background-color: white">
            <div class="col-md-10" style="padding-top: 1rem">
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0" style="width: 230px">
                        <img style="max-width: 100%" src="{{ asset('images/capsulas/' . $capsula->img_capsula) }}" alt="">
                    </div>
                    <div class="card-block px-2">
                        <h3 class="card-title" style="padding-top: 4rem;">{{ $capsula->nombre }}</h3>
                        {!! $capsula->descripcion !!}
                    </div>
                    <div class="w-100"></div>
                </div>
            </div>
            @include('main.components.aside')
        </div> --}}
        {{-- fila de abajo --}}
        <div class="row main">
            <div class="col-md-12">
                <h3>Ultimas Publicaciones</h3>
            </div>
            @foreach ($ultimas_publicaciones as $item)
                <div class="col-md-4">
                    <div class="card relacionadas">
                        <div class="img-contenedor-ultimas-pub">
                            <div class="box-2">
                                <img class="img-ediciones" src="{{ asset('images/abstract/' . $item->img_abstract) }}"
                                    alt="Card image">
                            </div>
                        </div>
                        <div class="card-body gray gray">
                            <h4 class="card-title">{{ Illuminate\Support\Str::of($item->titulo)->words(15) }}</h4>
                            <p class="card-text">{!! Illuminate\Support\Str::of($item->cuerpo)->words(25) !!}</p>
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
@endsection
