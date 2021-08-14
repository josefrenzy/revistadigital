@extends('main.app',['activePage'=>'revista','titlePage' => __('Revista FG')])
@section('content')
    <div class="content shadow">
        <div class="row main">
            <div class="col-md-10 main">
                <div class="col-md-12">
                    <h3 class="titulo-azul">Categorias: {{ $nombre }} </h3>
                </div>
                @foreach ($categorias as $item)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <div class="img-contenedor-ediciones">
                                    <div class="box-2-ediciones">
                                        <img class="img-ediciones"
                                            src="{{ asset('images/abstract/' . $item->img_abstract) }}" alt="Card image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 style="padding:1rem 0;" class="card-title text-uppercase">
                                        <strong>{{ $item->titulo }}</strong></h3>
                                    <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(50) !!}</div>
                                    <br>
                                    <a href="{{ route('revista.show', $item->id) }}"
                                        class="btn read-more text-lowercase">Leer más...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center last-posts" style="background-color: white">
                        <div class="col-lg-1">
                            <span>{{ $categorias->links() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Barra lateral --}}
            @include('main.components.aside')
        </div>
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
@endsection
