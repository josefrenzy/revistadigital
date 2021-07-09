@extends('layouts.app', ['activePage' => 'posts', 'titlePage' => __('Index Post')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Lista de Artículos</h4>
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('posts.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Artículo</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Titulo
                                        </th>
                                        <th>
                                            Autor
                                        </th>
                                        <th>
                                            Estatus
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>
                                                    {{ $post->id }}
                                                </td>
                                                <td>
                                                    {{ $post->titulo }}
                                                </td>
                                                <td>
                                                    {{ $post->name }}
                                                </td>
                                                <td>
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs">
                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('posts.edit', $post->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    {{-- <a href={{ route('posts.edit', $post->id) }}
                                                        class="btn btn-warning btn-sm">Editar</a> --}}
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <span>{{$posts->links()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
