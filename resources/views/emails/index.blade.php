@extends('layouts.app', ['activePage' => 'suscribe', 'titlePage' => __('Listado de suscripciones')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Lista de suscripciones</h4>
                            {{-- <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('posts.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Artículo</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Creación
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($suscripciones as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->id }}
                                                </td>
                                                <td>
                                                    {{ $item->email }}
                                                </td>
                                                <td>
                                                    {{ $item->created_at }}
                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-danger btn-link" href="{{ route('posts.edit', $item->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">clear</i>
                                                        <div class="ripple-container"></div>
                                                    </a>                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <span>{{$suscripciones->links()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
