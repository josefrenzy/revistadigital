@extends('main.app',['activePage'=>'index','titlePage' => __('Inicio')])

@section('content')
    <div class="content shadow">
        <div class="row main white">
            <div class="col-md-10 main white">
                <div class="hover hover-5 text-white rounded">
                    <img src="{{ asset('images/' . $post[0]->img_portada) }}" alt="">
                    <div class="hover-overlay"></div>
                    <div class="hover-5-content">
                        <h3 class="hover-5-title text-uppercase font-weight-light mb-0">
                            <strong class="font-weight-bold text-white">{{ $post[0]->titulo }}</strong>
                            <span>Autor: {{ $post[0]->name }}</span>
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 cuerpo-articulo">
                        {!! $post[0]->cuerpo !!}
                    </div>
                </div>
            </div>
            @include('main.components.aside')
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
        @include('main.components.suscribe')
    </div>
@endsection
