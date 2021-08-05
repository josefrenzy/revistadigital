@extends('main.app',['activePage'=>'revista','titlePage' => __('Revista FG')])
@section('content')
    <div class="content shadow">
        <div class="row main">
            <div class="col-md-10 main">
                <div class="col-md-12">
                    <h3 class="titulo-azul">Ediciones: {{ $nombre }} </h3>
                </div>
                @foreach ($ediciones as $item)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img class="card-img-top" src="{{ asset('images/' . $item->img_abstract) }}"
                                    alt="Card image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="background-color: #f2f2f2">
                                    <h5 class="card-title">{{ $item->titulo }}</h5>
                                    {!! $item->descripcion !!}
                                    <a href="{{ route('revista.show', $item->id) }}"
                                        class="btn read-more text-lowercase">Leer
                                        más...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row justify-content-center last-posts" style="background-color: white">
                    <div class="col-lg-1">
                        <span>{{ $ediciones->links() }}</span>
                    </div>
                </div>
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
                        <div class="img-contenedor-ediciones">
                            <div class="box-2">
                                <img class="img-ediciones" src="{{ asset('images/' . $item->img_abstract) }}"
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
