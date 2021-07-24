@extends('main.app',['activePage'=>'revista','titlePage' => __('Revista FG')])
@section('content')
    <div class="content shadow">
        <div class="row main">
            <div class="col-md-10 main">
                <div class="col-md-12">
                    <h3 class="titulo-azul">Categorias: {{ $nombre }} </h3>
                </div>
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                @if ($categorias->count() == 0)
                                    <h1>No hay datos para mostrar</h1>
                                @else
                                    <thead class="header-table">
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Titulo
                                        </th>
                                        <th>
                                            Edicion
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($categorias as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->id }}
                                                </td>
                                                <td>
                                                    {{ $item->titulo }}
                                                </td>
                                                <td>
                                                    {{ $item->nombre }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('revista.show', $item->id) }}">Ver</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
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
        </div>
    </div>

@endsection
