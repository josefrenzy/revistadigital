@extends('main.app',['activePage'=>'index','titlePage' => __('Inicio')])

@section('content')
    <div class="content shadow">
        <div class="row main" style="background-color: white">
            
            <div class="col-md-10" style="padding-top: 1rem">
                <div class="card flex-row flex-wrap">
                    <div class="card-header border-0" style="width: 230px">
                        <img style="max-width: 100%" src="{{ asset('images/capsulas/' . $capsula->img_capsula) }}" alt="">
                    </div>
                    <div class="card-block px-2">
                        <h3 class="card-title" style="padding-top: 4rem;">{{ $capsula->nombre }}</h3>
                        {!! $capsula->descripcion !!}
                        {{-- <p class="card-text">Description</p> --}}
                        {{-- <a href="#" class="btn btn-primary">BUTTON</a> --}}
                    </div>
                    <div class="w-100"></div>
                </div>
            </div>
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
